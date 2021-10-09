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
    while ($row = $rows) {
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
    while ($row = $rows) {
      $type = new TypeModel($row);
      array_push($types,  $type->getAll());
    }
    return $types;
  }

  public function create(array $data): string
  {
    $rules = [
      ['name' => 'required,string'],
      ['price' => 'required,number'],
      ['type_id' => 'required,int'],
      ['prop_content' => 'required,string'],
    ];
    $error = Validation::validationHelper($rules, $data);
    if ($error != '') {
      // header("HTTP/1.0 400 invalid data");
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

  private function _insertDb(string $query, array $params)
  {
    $stmt = $this->conn->prepare($query);
    $stmt->execute($params);
    $error = $this->_checkError();
    if ($error != null) {
      return $error;
    }
    return $stmt->fetch();
  }

  public function _checkTypeExists(int $id): ?string
  {
    $sql = "SELECT COUNT(*) AS types FROM types WHERE id = :type_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':type_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->fetch(PDO::FETCH_OBJ)->types == 0) {
      header("HTTP/1.0 500 internal server error");
      return "you have been passed unexisted type id";
    }
    return null;
  }

  public function delete(string $skus): string
  {
    $sql = "CALL DeleteProducts(?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$skus]);
    return "deleted";
  }


  private function _checkError()
  {
    if (isset($this->conn->errorInfo()[2])) {
      header("HTTP/1.0 500 internal server error");
      return json_encode($this->conn->errorInfo()[2]);
    }
    return null;
  }
}
