<?php 
namespace Models;

use PDO;

class AllProduct {
   private ProductModel $product;
   private PropertyModel $prop;
   private PDO $db;

   private array $products = [];
   public function __construct(PDO $db) {
       $this->product =  new ProductModel($db);
       $this->prop = new PropertyModel($db);
       $this->db = $db;
   }

<<<<<<< HEAD
   private function _mergeTwoModels():array{
       return array_merge($this->product->getAll() ,$this->prop->getAll() );
   }

   public function fetchAll():array{
    $sql = "call GetProducts();";
    $stmt = $this->db->query($sql);
    if (!$stmt) {
        die("Execute query error, because: " . print_r($this->db->errorInfo()[0], true));
      }
      while ($row = $stmt->fetch()) {
        $this->product->setAll($row['sku'] , $row['name'] , $row['price']);
        $this->prop->setAll($row['prop_name'] , $row['prop_unit'] , $row['prop_content'] , $row['sku']);
        $this->attachProduct();
      }
        return $this->products;
    }

   public function attachProduct():void{
    array_push($this->products , $this->_mergeTwoModels());
   }
=======
   public function mapToArray():array{
       return [
            "sku" => $this->product->getSku(),
            "name" => $this->product->getName(),
            "price" => $this->product->getPrice(),
            "prop_name" => $this->prop->getName(),
            "prop_unit" => $this->prop->getUnit(),
            "prop_content" => $this->prop->getContent(),
       ];
   }

   public function fetchAll():array{
    $sql = "call GetProducts();";
    $stmt = $this->db->query($sql);
    if (!$stmt) {
        die("Execute query error, because: " . print_r($this->db->errorInfo()[0], true));
      }
      while ($row = $stmt->fetch()) {
        $this->product->setAll($row['sku'] , $row['name'] , $row['price']);
        $this->prop->setAll($row['prop_name'] , $row['prop_unit'] , $row['prop_content'] , $row['sku']);
        $this->attachProduct();
      }
        return $this->products;
    }

   public function attachProduct():void{
    array_push($this->products , $this->mapToArray());
   }
>>>>>>> 7a8649cc54bbd760acfec4807387e2b4fa98ee34
  
}