<?php

namespace App;

use App\ProductController;
use App\Db;

class Api extends Router
{

  public function  __construct()
  {
    new Router([
      new Route('home_page', '/', [ProductController::class, 'getAll']),
      new Route('create_product', '/addnew', [ProductController::class, 'create'], ['POST']),
    ]);
  }

  public function init()
  {
    $route = $this->matchFromPath($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    $parameters = $route->getHandler();
    $controllerName = $parameters[0];
    $methodName = $parameters[1] ?? null;
    $db = new Db();
    $controller = new $controllerName($db);
    if (!is_callable($controller)) {
      $controller =  [$controller, $methodName];
    }
  }
}