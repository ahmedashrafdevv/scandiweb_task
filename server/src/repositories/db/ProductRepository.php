<?php

namespace App;

use App\Db;
use App\ProductModel;
use App\PropertyModel;
use PDO;
use App\Validation;
use PDOStatement;

class ProductRepository
{
  private PDO $db;
  public function __construct($db = null)
  {
    if ($db == null)
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
  public function getTypes()
  {
    $sql = "call GetTypes();";
    $stmt = $this->db->query($sql);
    $error = $this->_checkError();
    if ($error != null) {
      return $error;
    }
    $types = [];
    while ($row = $stmt->fetch()) {
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
      ['prop_name' => 'required,string'],
      ['prop_unit' => 'required,string'],
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
    $sql = "call CreateProduct(? , ? , ? , ? , ? , ? );";
    $product = new ProductModel($data);
    $prop = new PropertyModel($data);
    $stmt = $this->_insertDb($sql, [$product->getName(), $product->getPrice(), $product->getTypeId(), $prop->getPropName(), $prop->getPropUnit(), $prop->getPropContent()]);
    return json_encode($stmt);
  }

  private function _insertDb(string $query, array $params)
  {
    $stmt = $this->db->prepare($query);
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
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':type_id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->fetch(PDO::FETCH_OBJ)->types == 0) {
      return "you have been passed unexisted type id";
    }
    return null;
  }

  public function delete(string $sku):string{
    $sql = "CALL DeleteProduct(?)";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$sku]);
    if ($stmt->fetch(PDO::FETCH_OBJ)->types == 0) {
      return "you have been passed unexisted type id";
    }
    return null;

  }


  private function _checkError()
  {
    if (isset($this->db->errorInfo()[2])) {
      header("HTTP/1.0 500 internal server error");
      return json_encode($this->db->errorInfo()[2]);
    }
    return null;
  }
}
