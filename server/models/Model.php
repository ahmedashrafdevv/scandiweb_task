<?php
namespace Models;

use PDO;

abstract class Model
{
    protected  $db;
    public function __construct(PDO $db)
    {
       $this->db = $db;
    }
    public function create(array $input) : bool{
       echo $input;
        return true;
    }
   
}
