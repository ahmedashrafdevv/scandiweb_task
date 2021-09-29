<?php
namespace Router;

use Controllers\ProductController;
use Db\Db;

$router = new Router([
  new Route('home_page', '/', [ProductController::class , 'getAll']),
  new Route('create_product', '/addnew', [ProductController::class , 'create'] , ['POST']),

]);
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
  $arguments = $route->getAttributes();

  $controllerName = $parameters[0];
  $methodName = $parameters[1] ?? null;

  $db = new Db();
  $controller = new $controllerName($db);
  if (!is_callable($controller)) {
      $controller =  [$controller, $methodName];
  }

  echo $controller(...array_values($arguments));

} catch (\Exception $exception) {
  header("HTTP/1.0 404 Not Found");
}