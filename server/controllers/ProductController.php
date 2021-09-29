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
    $data =$this->requestBody;
    var_dump($data);
    return true;
  }
}
