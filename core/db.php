<?php

class DB {
    private string $DB_HOST;
    private string $DB_USER;
    private string $DB_PASS;
    private string $DB_PORT;
    private string $DB_NAME;
    private PDO $conn;

    /**
     * @throws Exception
     */
    public function __construct(string $config_name = "default")
    {
        $this->getConfig($config_name);
        $this->connect();
    }


    private function connect(): void
    {
        $this->conn = new PDO("mysql:host=" . $this->DB_HOST. ";port=" . $this->DB_PORT . ";dbname=" . $this->DB_NAME, $this->DB_USER, $this->DB_PASS);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function getConn(): PDO
    {
        return $this->conn;
    }

    /**
     * @throws Exception
     */
    private function getConfig(string $config_name): void
    {
        $config = require ROOT . DS . "config.php";
        if (!isset($config["database"]) || !isset($config["database"][$config_name])) {
            throw new Exception("Database configuration not found");
        }
        $this->DB_HOST = $config["database"][$config_name]["host"];
        $this->DB_USER = $config["database"][$config_name]["user"];
        $this->DB_PASS = $config["database"][$config_name]["password"];
        $this->DB_PORT = $config["database"][$config_name]["port"];
        $this->DB_NAME = $config["database"][$config_name]["dbname"];
    }
}