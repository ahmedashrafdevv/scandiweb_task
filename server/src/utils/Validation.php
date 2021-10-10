<?php

namespace App;

class Validation implements ValidationInterface {
    public static function validationHelper($rules , $request):?string{
        foreach ($rules as $key => $rule) {
            $validations = explode(',' , $rule[$key]);
            foreach ($validations as $validation){
                $error = self::$validation($key , $request);
                if($error != "" )
                  return $error;
             }
        }
        return null;
    }

    public static function required(string $key , array $request):string{
        if(!array_key_exists($key , $request))
            return "$key is required";
        
        
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