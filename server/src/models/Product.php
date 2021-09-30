<?php

namespace App;

class ProductModel extends Model implements ModelInterface
{
    private string $sku = "";
    private string $name;
    private float $price;
    private int $type_id = 0;

    public function __construct(array $record){
        $this->name = $record['name'];
        $this->price = $record['price']; 
        if(isset($record['sku']))
            $this->sku = $record['sku']; 
        if(isset($record['type_id']))
            $this->type_id = $record['type_id']; 
        
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
   
    public function getAll():array{
        $product = [
            "sku" => $this->sku,
            "name" => $this->name,
            "price" => $this->price,
        ];

        return $product;
    }

    public function create():string{
        return "true";
    }
}
