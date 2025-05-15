<?php

class Requester
{

    protected array $fields;
    protected array $external_fields;
    protected string $table;

    protected PDO $pdo;



    public function __construct(string $table, array $fields, array $external_fields, PDO $pdo)
    {
        $this->table = $table;
        $this->fields = $fields;
        $this->external_fields = $external_fields;
        $this->pdo = $pdo;
    }

    public function select(array $params): PDOStatement
    {
        // SELECT
        $out = "SELECT ";
        if (!isset($params["COLLUM"]) || count($params["COLLUM"]) == 0) {
            $out .= "* ";
        } else  {
            $out .= join(", ", $params["COLLUM"])." ";
        }

        // FROM
        $out .= "FROM ".$this->table;
        if (isset($params["INCLUDE"]) && count($params["INCLUDE"]) > 0) {
            $out .= $this->join($params["INCLUDE"]);
        }
        $out .= " ";

        $param = [];
        // WHERE
        if (isset($params["WHERE"]) && count($params["WHERE"]) > 0) {
            $t = $this->where($params["WHERE"]);
            $param = $t[1];
            $out .= " WHERE ". $t[0];
        }
        // LIMIT
        if (isset($params["LIMIT"]) && $params["LIMIT"] > 0) {
            $out .= " LIMIT ".$params["LIMIT"];
        }

        // OFFSET
        if (isset($params["OFFSET"]) && $params["OFFSET"] > 0) {
            $out .= " OFFSET ".$params["OFFSET"];
        }
        return $this->prepare($out, $param);
    }

    private function prepare(string $sql, array $param): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . implode(", ", $this->pdo->errorInfo()));
        }
        foreach ($param as $key => $value) {
            foreach ($value as $param_name => $param_value) {
                if (is_array($param_value)) {
                    $stmt->bindValue(":".$param_name, $param_value[0]);
                } else {
                    $stmt->bindValue(":".$param_name, $param_value);
                }
            }
        }
        return $stmt;
    }

    /**
     * @throws Exception
     */
    private function join(array $params): string
    {
        $out = "";
        foreach ($params as $value) {
            $find = false;
            foreach ($this->external_fields as $field_table => $field_external) {
                $external_table = explode(".", $field_external)[0];
                if (strcmp($external_table, $value) != 0) {
                   continue;
                }
                $find = true;
                $external_field = explode(".", $field_external)[1];
                break;
            }
            if (!$find) {
                throw new Exception("Table ".$value." not found in external fields");
            }
            $out .= " JOIN ".$value." ON ".$this->table.".".$field_table." = ".$external_table.".".$external_field;
        }
        return $out;
    }
    private function where(array $params): array
    {
        $out = "";
        $out_parameter = [];
        foreach ($params as $key => $value) {
            if ($key == "AND" ||  $key == "OR") {
                $out .= "(";
                $t = $this->where($value[0]);
                $out_parameter = array_merge($out_parameter, $t[1]);
                $out .= $t[0] . " " . $key . " ";
                $t = $this->where($value[1]);
                $out_parameter = array_merge($out_parameter, $t[1]);
                $out .= $t[0] . ")";
            }
            elseif ($key == "<" || $key == ">" || $key == "<=" || $key == ">=" || $key == "=" || $key == "!=" || $key == "LIKE") {
                $param_name = $this->get_random_parrams_name();

                $out .= $value[0] . " " . $key . " :".$param_name;
                $out_parameter[] = [
                    $param_name => $value[1]
                ];
            }
            elseif (is_array($value) and count($value) > 1) {
                $out .= $key . " IN (";
                $out .= join(", ", array_map(function ($value) use(&$out_parameter) {
                    $param_name = $this->get_random_parrams_name();
                    $out_parameter[] = [
                        $param_name => $value
                    ];
                    return ":".$param_name;
                }, $value));
                $out .= ")";
            } else {
                $param_name = $this->get_random_parrams_name();
                $out .= $key . " = :".$param_name;
                $out_parameter[] = [
                    $param_name => (is_array($value) ? $value[0] : $value)
                ];
            }
        }

        return [
            $out,
            $out_parameter
        ];
    }

    private function get_random_parrams_name(): string
    {
        $out = "";
        for ($i = 0; $i < 10; $i++) {
            $out .= chr(rand(97, 122));
        }
        return $out;
    }

    /**
     * @throws Exception
     */
    public function insert(array $params): PDOStatement
    {
        $out = "INSERT INTO ".$this->table." (";
        $out .= join(", ", array_keys($params)).") VALUES (";
        $out .= join(", ", array_map(function ($value) use (&$param) {
            $t = $this->get_random_parrams_name();
            $param[] = [
                $t => $value
            ];
            return ":".$t;
        }, array_values($params))).")";
        return $this->prepare($out, $param);
    }

    /**
     * @throws Exception
     */
    public function update(array $params): PDOStatement
    {
        if (!isset($params["DATA"]) || count($params["DATA"]) == 0) {
            throw new Exception("No DATA found for UPDATE");
        }
        if (!isset($params["WHERE"]) || count($params["WHERE"]) == 0) {
            throw new Exception("No WHERE found for UPDATE");
        }
        $out = "UPDATE " . $this->table;
        if (isset($params["INCLUDE"]) && count($params["INCLUDE"]) > 0) {
            $out .= $this->join($params["INCLUDE"]);
        }
        $out .= " SET ";
        $param = [];
        $out .= join(", ", array_map(function ($key, $value) use (&$param) {
            $t = $this->get_random_parrams_name();
            $param[] = [
                $t => $value
            ];
            return $key . " = :".$t;
        }, array_keys($params["DATA"]), array_values($params["DATA"])));
        $t = $this->where($params["WHERE"]);
        $out .= " WHERE ".$t[0];

        return $this->prepare($out, array_merge($param, $t[1]));
    }

    /**
     * @throws Exception
     */
    public function delete(array $params): PDOStatement
    {
        /** @noinspection SqlWithoutWhere */
        $out = "DELETE FROM ".$this->table;
        $param = [];
        if (isset($params["WHERE"]) && count($params["WHERE"]) > 0) {
            $t = $this->where($params["WHERE"]);
            $out .= " WHERE ".$t[0];
            $param = $t[1];
        } else {
            throw new Exception("No WHERE clause found for DELETE");
        }
        return $this->prepare($out, $param);
    }

    public function count(array $parrams)
    {
        $out = "SELECT COUNT(*) FROM ".$this->table;
        $param = [];
        if (count($parrams) > 0) {
            $t = $this->where($parrams);
            $out .= " WHERE ".$t[0];
            $param = $t[1];
        }
        return $this->prepare($out, $param);
    }
}