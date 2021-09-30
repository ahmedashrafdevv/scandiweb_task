<?php

namespace App;

class TypeModel extends Model{
    private string $name;
    private int $id;
    // private self $allTypes ;
    public function __construct(array $record){
        $this->id = $record['id'];
        $this->name = $record['name']; 
    }
   
}