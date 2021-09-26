<?php


class PropertyModel {
    private string $name;
    private string $unit;
    private string $content;
    private string $productSku;

    public function getName(){
        return $this->name;
    }
    public function getUnit(){
        return $this->unit;
    }
    public function getContent(){
        return $this->content;
    }
    public function getProductSku(){
        return $this->productSku;
    }

    public function setName($name){
        $this->name = $name;
    }
    public function setUnit($unit){
        $this->unit = $unit;
    }
    public function setContent($content){
        $this->content = $content;
    }
    public function setProductSku($productSku){
        $this->productSku = $productSku;
    }
    


}