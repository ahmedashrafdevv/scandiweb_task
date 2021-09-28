<?php

namespace Models;

class TypeModel extends Model{
    private string $name;
    private int $id;
    // private self $allTypes ;

    public function getName():string{
        return $this->name;
    }
    public function getId():int{
        return $this->id;
    }

    public function setName($name):void{
        $this->name = $name;
    }

    public function create($input):bool{
        echo $input;
        return true;
    }
}