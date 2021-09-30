<?php
namespace Db;

use PDO;
use PDOException;

class Db
{
    private string $dbhost ;
    private string   $dbuser ;
    private string $dbpass ;
    private string $dbname ;
    public function __construct()
    {
        $this->dbhost = getenv("DB_HOST");
        $this->dbuser = getenv("DB_USER");
        $this->dbpass = getenv("DB_PASSWORD");
        $this->dbname = getenv("DB_NAME");
        
    }

    public function getConnection():PDO
    {
        $dsn = "mysql:host=$this->dbhost;dbname=$this->dbname;charset=UTF8";
        try {
            $pdo = new PDO($dsn, $this->dbuser, $this->dbpass, [PDO::ATTR_ERRMODE=> PDO::ERRMODE_WARNING,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            return $pdo;
        } catch (PDOException $e) {
            die("error while connecting to db : $e->getMessage()");
        }
    }
}
