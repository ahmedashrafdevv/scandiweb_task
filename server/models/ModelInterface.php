<?php

namespace Models;
interface ModelInterface  {
    public function getAll():array;
    public function create():string;
}