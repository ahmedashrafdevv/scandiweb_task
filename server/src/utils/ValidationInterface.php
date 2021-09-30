<?php

namespace App;
interface ValidationInterface  {
    public static function required(string $key , array $request):string;
    public static function number(string $key , array $request):string;
    public static function int(string $key , array $request):string;
    public static function string(string $key , array $request):string;
}