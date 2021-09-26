<?php

use Utils\Env;

class Db{
    private string $dbhost  ;
    private string   $dbuser ;
    private string $dbpass ;
    private string $dbname ;
    private  $db;
    public function __construct()
    {   
        $this->dbhost = getenv("DB_HOST");
        $this->dbuser = getenv("DB_USER");
        $this->dbpass = getenv("DB_PASSWORD");
        $this->dbname = getenv("DB_NAME");
        $this->connect();
    }
    
    public function connect(){
        $db = new mysqli($this->dbhost, $this->dbuser, $this->dbpass,$this->dbname) or die("Connect failed: %s\n". $this->db -> error);
        $this->db = $db;
    }
    public function getDb(){
        return $this->db;
    }
    
}
