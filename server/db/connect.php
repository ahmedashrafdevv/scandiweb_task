<?php

use Utils\Env;

class Db{
    private string $dbhost  ;
    private string   $dbuser ;
    private string $dbpass ;
    private string $dbname ;
    protected static $db ;
    public function __construct($dbhost, $dbuser ,$dbpass ,$dbname) {
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbname = $dbname;
    }
    function __destruct() {
        $this->close();
    }
    public function connect(){
        $this->db = new mysqli($this->dbhost, $this->dbuser, $this->dbpass,$this->dbname) or die("Connect failed: %s\n". $this->db -> error);
    }
    public function getConnection() {
       $this->connect();
        // echo "hi";
        return $this->db;
    }
    public function close(){
        $this->db -> close();
    }
}
