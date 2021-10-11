<?php

namespace App;

class TypeModel{
    private int $id;
    private string $name;
    private string $prop_name;
    private string $prop_unit;
    // private self $allTypes ;
    public function __construct(array $record){
        foreach(array_keys($record) as $key){
            if(property_exists($this, $key)){
                $this->$key = $record[$key];       
            }
        }   
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