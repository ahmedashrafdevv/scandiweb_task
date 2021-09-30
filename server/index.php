<?php

namespace App;
require 'vendor/autoload.php';
include_once "src/db/Db.php";
include_once 'src/inetrfaces/RequestInterface.php';
include_once 'src/utils/Env.php';
include_once 'src/controllers/Controller.php';
include_once 'src/controllers/ProductController.php';
include_once 'src/models/Model.php';
include_once 'src/models/ModelInterface.php';
include_once 'src/utils/ValidationInterface.php';
include_once 'src/utils/Validation.php';
include_once 'src/models/Product.php';
include_once 'src/models/Property.php';
include_once 'src/repositories/db/ProductRepository.php';
include_once 'src/router/Traits/RouteTrait.php';
include_once 'src/router/RouterInterface.php';
include_once "src/router/Router.php";
include_once 'src/router/Route.php';
include_once 'src/router/UrlGenerator.php';
include_once 'src/models/AllProduct.php';
use App\ProductController;

use App\Db;
use App\Env;

use App\Api;
use App\Route;
use App\Router;

(new Env(__DIR__ . '/.env'));
include_once 'router/Api.php';

$router = new Router([
    new Route('home_page', '/', [ProductController::class, 'getAll']),
    new Route('create_product', '/addnew', [ProductController::class, 'create'], ['POST']),
  ]);
   function init($router)
  {
    try {
        // Example
        // \Psr\Http\Message\ServerRequestInterface
        //$route = $router->match(ServerRequestFactory::fromGlobals());
        // OR
    
        // $_SERVER['REQUEST_URI'] = '/api/articles/2'
        // $_SERVER['REQUEST_METHOD'] = 'GET'
        $route = $router->matchFromPath($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    
        $parameters = $route->getHandler();
        // $arguments = ['id' => 2]
        $arguments = $route->getVarsNames();
    
        $controllerName = $parameters[0];
        $methodName = $parameters[1] ?? null;
    
        $controller = new $controllerName();
        if (!is_callable($controller)) {
            $controller =  [$controller, $methodName];
        }
    
        echo $controller(...array_values($arguments));
    
    } catch (\Exception $exception) {
        header("HTTP/1.0 404 Not Found");
    }
  }
  init($router);
