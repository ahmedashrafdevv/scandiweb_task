<?php
namespace Controllers;

use Repositories\db\ProductRepository;

abstract class Controller{
   protected  array $requestBody ;
   protected ProductRepository $repository;
   public function __construct()
   {
      $this->repository = new  ProductRepository();
      $body = json_decode(file_get_contents('php://input'), true);
      $this->requestBody = is_array($body) ?
              json_decode(file_get_contents('php://input'), true)
         :
           [];
   }

  
}
