<?php
namespace App;


class ProductController extends Controller
{
  
  public  function  getAll():string     
  {
    return json_encode($this->repository->fetchAll());
  }

  public  function  getTypes():string     
  {
    return json_encode($this->repository->getTypes());
  }
  public function create():string
  {
    $data =$this->requestBody;

   
    return  $this->repository->create($data);
  }


  
  public function delete()
  {
    $data =$this->requestBody;
    foreach ($data as $sku){
      $this->repository->delete($sku);
    }

    return "deleted";
  }
}
