<?php

namespace Models;

class ProductModel extends Model implements ModelInterface
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
   
    public function getAll():array{
        return [
            "sku" => $this->sku,
            "name" => $this->name,
            "price" => $this->price,
        ];
    }
   

    public function create($input):string{
        var_dump($this->db);
        return "true";
    }
}
