<?php


class TypeModel {
    private string $name;
    private int $id;
    // private self $allTypes ;

    public function getName(){
        return $this->name;
    }
    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }
    public function setId($id){
        $this->unit = $id;
    }
}