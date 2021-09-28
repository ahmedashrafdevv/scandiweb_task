<?php

namespace Models;

class ProductModel extends Model
{
    private string $sku;
    private string $name;
    private float $price;
    private int $typeId;
    public function setAll(string $sku ,string $name , string $price ):void{
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }
    public function getSku():STRING
    {
        return $this->sku;
    }
    public function getName():STRING
    {
        return $this->name;
    }
    public function getPrice():float
    {
        return $this->price;
    }
    public function setSku($sku):void
    {
        $this->sku = $sku;
    }
    public function setName($name):void
    {
        $this->name = $name;
    }
    public function setPrice($price):void
    {
        $this->price = $price;
    }

    public function create( $input):bool{
        var_dump($this->db);
        return true;
    }
}
