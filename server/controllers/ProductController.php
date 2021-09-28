<?php
namespace Controllers;

use Models\AllProduct;
use Models\PropertyModel;
use Models\ProductModel;

class ProductController extends Controller
{
  public  function  getAll():string     
  {
    
    $sql = "call GetProducts();";
    $stmt = $this->getDb()->query($sql);
    //error case
    if (!$stmt) {
      die("Execute query error, because: " . print_r($this->getDb()->errorInfo()[0], true));
    }
    //success case
    else {
      //continue flow
    }
    $products = [];
    while ($row = $stmt->fetch()) {
      $product = new ProductModel($this->getDb());
      $prop = new PropertyModel($this->getDb());
      $product->setSku($row['sku']);
      $product->setName($row['name']);
      $product->setPrice($row['price']);
      $prop->setName($row['prop_name']);
      $prop->setUnit($row['prop_unit']);
      $prop->setContent($row['prop_content']);
      $prop->setProductSku($row['sku']);
      $allProduct = new  AllProduct($product , $prop);
      array_push($products , $allProduct->getAll());
    }
    // print_r($products) ;
 
    return json_encode($products);
  }
  public function create():bool
  {
    $product = new ProductModel($this->getDb());
    $product->create(["product"]);
    $prop = new PropertyModel($this->getDb());
    $prop->create(["prop"]);
    return true;
  }
}

// if ($q->num_rows >= 1){
//     $prs = [];
//     while($prs = $q->fetch_assoc()){
//       $prs[] = array_map("stripslashes", $article) ; //Call the function for each row
//     }
//   } else
//     echo "No rows" ;

// }