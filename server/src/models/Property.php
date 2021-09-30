<?php

namespace App;


class PropertyModel extends Model implements ModelInterface{
    private string $prop_name;
    private string $prop_unit;
    private string $prop_content;
    public function __construct(array $record){
        $this->prop_name = $record['prop_name'];
        $this->prop_unit = $record['prop_unit'];
        $this->prop_content = $record['prop_content'];
    }
    public function getAll():array{
        return [
            "prop_name" => $this->prop_name,
            "prop_unit" => $this->prop_unit,
            "prop_content" => $this->prop_content,
        ];
    }

    public function getPropName():string{
        return $this->prop_name;
    }
    public function getPropUnit():string{
        return $this->prop_unit;
    }
    public function getPropContent():string{
        return $this->prop_content;
    }

    public function create():string{
        // echo "Asd";
        return "true";
    }
    


}