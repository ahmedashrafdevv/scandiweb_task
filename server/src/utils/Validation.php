<?php

namespace App;

class Validation implements ValidationInterface {
    public static function validationHelper($fields , $request):string{
        foreach ($fields as  $field) {
           $key = array_keys($field)[0];
           $rules = explode(',' , $field[$key]);
           foreach ($rules as $rule){
              $error = self::$rule($key , $request);
              if($error != "" )
                return $error;
           }
        }
        return "";
    }

    public static function required(string $key , array $request):string{
        if(!array_key_exists($key , $request))
            return "$key is   required";
        
        
        return "";
    }
    public static function number(string $key , array $request):string{
        if(!is_double($request[$key]) && !is_int($request[$key]))
            return "$key must be number";
        
        return "";
    }
    public static function int(string $key , array $request):string{
        if(!is_int($request[$key]))
            return "$key must be integer";
        
        return "";
    }
    public static function string(string $key , array $request):string{
        if(!is_string($request[$key]))
            return "$key must be string";
        return "";
    }


}