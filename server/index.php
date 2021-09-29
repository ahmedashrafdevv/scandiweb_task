<?php
use Utils\Env;

include_once "db/Db.php";
include_once 'inetrfaces/RequestInterface.php';
include_once 'utils/Env.php';
include_once 'controllers/Controller.php';
include_once 'controllers/ProductController.php';

include_once 'models/Model.php';
include_once 'models/Product.php';
include_once 'models/Property.php';
include_once 'models/AllProduct.php';
include_once "router/Exception/RouteNotFound.php";
include_once 'router/Traits/RouteTrait.php';
<<<<<<< HEAD
include_once 'router/RouterInterface.php';
=======
>>>>>>> 7a8649cc54bbd760acfec4807387e2b4fa98ee34
include_once "router/Router.php";
include_once 'router/Route.php';
include_once 'router/UrlGenerator.php';
include_once 'models/AllProduct.php';
(new Env(__DIR__ . '/.env'));
include_once 'router/Api.php';




// $router = new Router([
//   new Route('home_page', '/', [ProductController::class , 'getAll']),

// ]);
// try {
//   // Example
//   // \Psr\Http\Message\ServerRequestInterface
//   //$route = $router->match(ServerRequestFactory::fromGlobals());
//   // OR

//   // $_SERVER['REQUEST_URI'] = '/api/articles/2'
//   // $_SERVER['REQUEST_METHOD'] = 'GET'
//   $route = $router->matchFromPath($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

//   $parameters = $route->getHandler();
//   // $arguments = ['id' => 2]
//   $arguments = $route->getAttributes();

//   $controllerName = $parameters[0];
//   $methodName = $parameters[1] ?? null;

  
//   $controller = new $controllerName();
//   if (!is_callable($controller)) {
//       $controller =  [$controller, $methodName];
//   }

//   echo $controller(...array_values($arguments));

// } catch (\Exception $exception) {
//   header("HTTP/1.0 404 Not Found");
// }