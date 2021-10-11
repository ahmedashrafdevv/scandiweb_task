<?php

namespace App;

class ProductModel implements ModelInterface
{
    private string $sku = "";
    private string $name;
    private float $price;
    private int $type_id = 0;
    private string $prop_content = "";
    private string $prop_name = "";
    private string $prop_unit = "";

    public function __construct(array $record){
        foreach(array_keys($record) as $key){
            if(property_exists($this, $key)){
                $this->$key = $record[$key];       
            }
        }        
    }

    public function setSku(string $sku):void{
        $this->sku = $sku;
    }

    public function getName():string{
        return $this->name;
    }
    public function getSku():string{
        return $this->sku;
    }
    public function getPrice():float{
        return $this->price;
    }
    public function getTypeId():int{
        return $this->type_id;
    }
    public function getPropContent():string{
        return $this->prop_content;
    }
   
    public function getAll():array{
        $product = [
            "sku" => $this->sku,
            "name" => $this->name,
            "price" => $this->price,
            "prop_content" => $this->prop_content,
            "prop_name" => $this->prop_name,
            "prop_unit" => $this->prop_unit,
        ];

        return $product;
    }

    public function create():string{
        return "true";
    }
}
