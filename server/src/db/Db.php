<?php

namespace App;

use PDO;
use PDOException;

class Db
{
    private string $dbhost;
    private string   $dbuser;
    private string $dbpass;
    private string $dbname;
    private PDO $conn;
    public function __construct()
    {
        //  dd("hi");
        $this->dbhost = getenv("DB_HOST");
        $this->dbuser = getenv("DB_USER");
        $this->dbpass = getenv("DB_PASSWORD");
        $this->dbname = getenv("DB_NAME");


        // connect to db
        $this->conn = $this->_connect();
    }

    private function _connect()
    {
        $dsn = "mysql:host=$this->dbhost;dbname=$this->dbname;charset=UTF8";
        try {
            $conn = new PDO($dsn, $this->dbuser, $this->dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            return $conn;
        } catch (PDOException $e) {
            header("HTTP/1.0 500 internal server error");
            die("error while connecting to db : $e->getMessage()");
        }
    }

    public function getConnection(): PDO
    {
        // dd(getenv("DB_NAME"));
        return $this->conn;
    }


    public function resetDb(): void
    {
        // reset database
        $sql = "SET foreign_key_checks = 0;TRUNCATE TABLE products";
        $stmt  = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function queryDb(String $sql)
    {
        $stmt = $this->conn->query($sql);
        $error = $this->_checkError();
        if ($error != null) {
            return $error;
        }
        return $stmt->fetch();
    }
    private function _checkError()
    {
        if (isset($this->conn->errorInfo()[2])) {
            header("HTTP/1.0 500 internal server error");
            return json_encode($this->conn->errorInfo()[2]);
        }
        return null;
    }

    public function insertDb(String $sql, array $args): string
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($args);
        $error = $this->_checkError();
        if ($error != null) {
            return $error;
        }
        return json_encode($stmt->fetch());
    }
}
