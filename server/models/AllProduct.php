<?php 
namespace Models;

class AllProduct {
   private ProductModel $product;
   private PropertyModel $prop;
   public function __construct(ProductModel $product, PropertyModel $prop) {
       $this->product = $product;
       $this->prop = $prop;
   }

   public function getAll():array{
       return [
            "sku" => $this->product->getSku(),
            "name" => $this->product->getName(),
            "price" => $this->product->getPrice(),
            "prop_name" => $this->prop->getName(),
            "prop_unit" => $this->prop->getUnit(),
            "prop_content" => $this->prop->getContent(),
       ];
   }
}