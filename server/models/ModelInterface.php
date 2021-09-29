<?php

namespace Models;
interface ModelInterface  {
    public function setAll():void;
    public function getAll():array;
    public function create():string;
}