<?php

class Db{
    private string $dbhost  ;
    private string   $dbuser ;
    private string $dbpass ;
    private string $dbname ;
    private  $db ;
    public function __construct($dbhost, $dbuser ,$dbpass ,$dbname) {
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbname = $dbname;
    }
    public function connect(){
        $this->db = new mysqli($this->dbhost, $this->dbuser, $this->dbpass,$this->dbname) or die("Connect failed: %s\n". $this->db -> error);
        return $this->db;
    }
    public function close(){
        $this->db -> close();
    }
}
