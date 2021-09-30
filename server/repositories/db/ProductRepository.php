<?php

namespace Repositories\db;

use Db\Db;
use Exception;
use Models\ProductModel;
use Models\PropertyModel;
use PDO;
use Utils\Validation;

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
  protected function _insertDb(string $query ,array $params){
    $stmt = $this->db->prepare($query);
      $stmt->execute($params);
      if (isset( $stmt->errorInfo()[2])){
        throw new Exception("Error while inserting to db:", $stmt->errorInfo()[2]);
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
    $product = new ProductModel($data);
    $sql = "call CreateProduct(? , ? , ? , ?);";
    $stmt = $this->_insertDb($sql , [$product->getName(),$product->getPrice(), $product->getTypeId() , 12121]);


    $sku = $stmt['uuid'];   
    $prop = new PropertyModel($data);
    $sql = "call CreateProperty(? , ? , ? , ? );";
    $stmt = $this->_insertDb($sql , [$prop->getPropName(),$prop->getPropUnit(), $prop->getPropContent() , $sku]);

    return "product created successfully";
  }
}
