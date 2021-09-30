<?php
require __DIR__.'/vendor/autoload.php';
include_once "db/Db.php";
include_once 'inetrfaces/RequestInterface.php';
include_once 'utils/Env.php';
include_once 'controllers/Controller.php';
include_once 'controllers/ProductController.php';
include_once 'models/Model.php';
include_once 'models/ModelInterface.php';
include_once 'utils/ValidationInterface.php';
include_once 'utils/Validation.php';
include_once 'models/Product.php';
include_once 'models/Property.php';
include_once 'repositories/db/ProductRepository.php';
include_once 'router/Traits/RouteTrait.php';
include_once 'router/RouterInterface.php';
include_once "router/Router.php";
include_once 'router/Route.php';
include_once 'router/UrlGenerator.php';
include_once 'models/AllProduct.php';
use Controllers\ProductController;

use Db\Db;
use Utils\Env;

use Router\Api;
use Router\Route;
use Router\Router;

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
