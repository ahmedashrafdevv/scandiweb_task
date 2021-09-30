<?php
namespace App;


class ProductController extends Controller
{
  
  public  function  getAll():string     
  {
    return json_encode($this->repository->fetchAll());
  }
  public function create():string
  {
    $data =$this->requestBody;
    return  $this->repository->create($data);
  }
}
