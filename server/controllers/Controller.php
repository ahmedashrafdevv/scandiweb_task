<?php

abstract class Controller {
    protected $db ;
    public function __construct() {
        $con = new Db("localhost" , "root" , "asd@asd@" , "scandiweb_products");
        $this->db = $con->getConnection();
    }
}
