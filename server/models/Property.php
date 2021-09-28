<?php

namespace Models;

class PropertyModel extends Model{
    private string $name;
    private string $unit;
    private string $content;
    private string $productSku;

    public function getName():string{
        return $this->name;
    }
    public function getUnit():string{
        return $this->unit;
    }
    public function getContent():string{
        return $this->content;
    }
    public function getProductSku():string{
        return $this->productSku;
    }

    public function setName($name):void{
        $this->name = $name;
    }
    public function setUnit($unit):void{
        $this->unit = $unit;
    }
    public function setContent($content):void{
        $this->content = $content;
    }
    public function setProductSku($productSku):void{
        $this->productSku = $productSku;
    }

    public function create($input):bool{
        echo $input;
        return true;
    }
    


}