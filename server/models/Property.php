<?php

namespace Models;

class PropertyModel extends Model implements ModelInterface{
    private string $name;
    private string $unit;
    private string $content;
    private string $productSku;
    public function setAll(string $name ,string $unit , string $content,string $productSku ):void{
        $this->name = $name;
        $this->unit = $unit;
        $this->content = $content;
        $this->productSku = $productSku;
    }
    public function getAll():array{
        return [
            "poperty_name" => $this->name,
            "poperty_unit" => $this->unit,
            "poperty_content" => $this->content,
        ];
    }
   

    public function create($input):string{
        echo $input;
        return "true";
    }
    


}