<?php

namespace App;

class TypeModel{
    private int $id;
    private string $name;
    private string $prop_name;
    private string $prop_unit;
    // private self $allTypes ;
    public function __construct(array $record){
        $this->id = $record['id'];
        $this->name = $record['name']; 
        $this->prop_name = $record['prop_name']; 
        $this->prop_unit = $record['prop_unit']; 
    }


    public function getAll():array{
        return [
            "id" => $this->id,
            "name" => $this->name,
            "prop_name" => $this->prop_name,
            "prop_unit" => $this->prop_unit
        ];
    }
   
}