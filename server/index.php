<?php
namespace App;
require 'vendor/autoload.php';



(new Env(__DIR__ . '/.env'));



$api =   new Api();
