<?php

class Model extends DB
{
    protected array $fields;
    protected array $externalFields;
    protected string $table;
    protected string $primaryKey;


    protected Requester $requester;

    public function __construct(string $config_name = "default") {
        parent::__construct($config_name);


        if (method_exists($this, "__init")) {
            $this->__init();
        }

        $this->requester = new Requester($this->table, $this->fields, $this->externalFields, $this->getConn());
    }

    public function findAll(array $parrams = []): array
    {
        $stmt = $this->requester->select($parrams);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function find(array $parrams = []): array|false
    {
        $stmt = $this->requester->select($parrams);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete(int $pk_value) {

        $stmt = $this->requester->delete([
            "WHERE" => [
                $this->primaryKey => $pk_value
            ]
        ]);
        $stmt->execute();
    }

    public function create($parrams): int {
        $stmt = $this->requester->insert($parrams);
        $stmt->execute();
        return $this->getConn()->lastInsertId();
    }

    public function count(array $parrams = []): int {
        $stmt = $this->requester->count($parrams);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

}

