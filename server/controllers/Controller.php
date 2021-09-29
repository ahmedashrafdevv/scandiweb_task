<?php
namespace Controllers;

use Db\Db;
use PDO;

abstract class Controller{
   private Db $db ;
   protected  array $requestBody ;
   protected PDO $pdo ;
   public function __construct()
   {
      $db = new Db();
      $this->db = $db;
      $this->pdo = $this->db->getConnection(); 
      if( is_array( json_decode(file_get_contents('php://input'), true)))
         $this->requestBody =  json_decode(file_get_contents('php://input'), true);
   }

   public function getDb():PDO
   {    
      return  $this->pdo;
   }
  
}
