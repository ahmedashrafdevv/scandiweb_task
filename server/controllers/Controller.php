<?php
namespace Controllers;

use Db\Db;
use PDO;

abstract class Controller{
   private Db $db ;
   protected PDO $pdo ;
   public function __construct()
   {
      $db = new Db();
      $this->db = $db;
      $this->pdo = $this->db->getConnection(); 
   }

   public function getDb():PDO
   {    
      return  $this->pdo;
   }
}
