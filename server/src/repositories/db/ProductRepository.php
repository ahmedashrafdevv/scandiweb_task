<?php

namespace App;

use App\Db;
use App\Exception;
use App\ProductModel;
use App\PropertyModel;
use PDO;
use App\Validation;
use Exception as GlobalException;

class ProductRepository
{
  private PDO $db;
  public function __construct()
  {
    $db = new Db();
    $conn = $db->getConnection();
    $this->db = $conn;
  }
  public function fetchAll(): array
  {
    $sql = "call GetProducts();";
    $stmt = $this->db->query($sql);
    if (!$stmt) {
      die("Execute query error, because: " . print_r($this->db->errorInfo()[0], true));
    }
    $products = [];
    while ($row = $stmt->fetch()) {
      $product = new ProductModel($row);
      $prop = new PropertyModel($row);
      array_push($products,  array_merge($product->getAll(), $prop->getAll()));
    }
    return $products;
  }
  public function GetTypes()
  {
    $sql = "call GetTypes();";
    $stmt = $this->db->query($sql);
    if (!$stmt) {
      die("Execute query error, because: " . print_r($this->db->errorInfo()[0], true));
    }
    $types = [];
    while ($row = $stmt->fetch()) {
      $type = new TypeModel($row);
      array_push($types,  $type);
    }
    return $types;
  }
  protected function _insertDb(string $query ,array $params){
    $stmt = $this->db->prepare($query);
      $stmt->execute($params);
      if (isset( $stmt->errorInfo()[2])){
        throw new GlobalException("Error while inserting to db:", json_encode($stmt->errorInfo()[2]));
      }
      return $stmt->fetch();
  }
  public function create(array $data): string
  {
    $rules = [
      ['name' => 'required,string'],
      ['price' => 'required,number'],
      ['type_id' => 'required,int'],
      ['prop_name' => 'required,string'],
      ['prop_unit' => 'required,string'],
      ['prop_content' => 'required,string'],
    ];
    $error = Validation::validationHelper($rules, $data);
    if ($error != '') {
      return $error;
    }
    //create product
    $sql = "call CreateProduct(? , ? , ? , ? , ? , ?);";
    $product = new ProductModel($data);
    $prop = new PropertyModel($data);
    $stmt = $this->_insertDb($sql , [$product->getName(),$product->getPrice(), $product->getTypeId() , $prop->getPropName(),$prop->getPropUnit(), $prop->getPropContent()]);
    return "product created successfully";
  }
}
