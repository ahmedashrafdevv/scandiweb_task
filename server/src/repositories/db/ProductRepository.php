<?php

namespace App;

use App\Db;
use App\ProductModel;
use PDO;
use App\Validation;

class ProductRepository
{
  private Db $db;
  private PDO $conn;
  public function __construct()
  {
    $db = new Db();
    $conn = $db->getConnection();
    $this->db = $db;
    $this->conn = $conn;
  }
  public function fetchAll(): array
  {
    $sql = "call GetProducts();";

    $rows = $this->db->queryDb($sql);
    if(!is_array($rows)){
      return $rows;
    }
    $products = [];
    foreach ($rows as $row){
      $product = new ProductModel($row);
      array_push($products, $product->getAll());
    }
    return $products;
  }
  public function getTypes()
  {
    $sql = "call GetTypes();";
    $rows = $this->db->queryDb($sql);
    if(!is_array($rows)){
      return $rows;
    }
    $types = [];
    foreach ($rows as $row) {
      $type = new TypeModel($row);
      array_push($types,  $type->getAll());
    }
    return $types;
  }

  public function create(array $data): string
  {
    $rules = [
      'name' => 'required,string',
      'price' => 'required,number',
      'type_id' => 'required,int',
      'prop_content' => 'required,string',
    ];
    // validate the request
    $error = Validation::validationHelper($rules, $data);

    // if error is null the means the request is vlid
    // so if  not we need to stop the proccess and show error
    if ($error != null) {
      http_response_code(400);
      return $error;
    }

    // check if the type exists
    $error = $this->_checkTypeExists($data['type_id']);
    if ($error != null) {
      return $error;
    }

    //create product
    $sql = "call CreateProduct(? , ? , ? , ?);";
    $product = new ProductModel($data);
    $stmt = $this->db->insertDb($sql, [$product->getName(), $product->getPrice(), $product->getTypeId(), $product->getPropContent()]);
    return json_encode($stmt);
  }


  public function delete(string $skus): string
  {
    $sql = "CALL DeleteProducts(?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$skus]);
    return "deleted";
  }


  
  public function _checkTypeExists(int $id): ?string
  {
    $sql = "SELECT COUNT(*) AS types FROM types WHERE id = :type_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':type_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->fetch(PDO::FETCH_OBJ)->types == 0) {
      http_response_code(400);
      return "you have been passed unexisted type id";
    }
    return null;
  }
}
