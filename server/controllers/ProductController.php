<?php
namespace Controllers;

use Models\AllProduct;
use Models\PropertyModel;
use Models\ProductModel;

class ProductController extends Controller
{
  public  function  getAll():string     
  {
    $allProduct = new  AllProduct($this->getDb());
    return json_encode($allProduct->fetchAll());
  }
  public function create():bool
  {
    $data = json_decode(file_get_contents('php://input'), true);
    var_dump($data);
    // $product = new ProductModel($this->getDb());
    // $product->create(["product"]);
    // $prop = new PropertyModel($this->getDb());
    // $prop->create(["prop"]);
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