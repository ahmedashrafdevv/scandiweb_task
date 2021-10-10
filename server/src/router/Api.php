<?php

namespace App;

use App\ProductController;
use App\Db;

// this file is responsible of defining api route by creating a new instance of router class and passes our 3 routes to the constructor

// our routes is very simple
  // GET: "/" get all products from db
  // POST: "/addnewe" insert ne product to db
  // DELETE: "/delete" delete array of products from db

class Api
{

  public function  __construct()
  {
    $router = new Router([
      new Route('home_page', '/', [ProductController::class, 'getAll']),
      new Route('get_types', '/types', [ProductController::class, 'getTypes']),
      new Route('create_product', '/addnew', [ProductController::class, 'create'], ['POST']),
      new Route('delete_products', '/delete', [ProductController::class, 'delete'], ["DELETE"]),
    ]);

    $this->init($router);
  }

  public function init($router)
  {

    $route = $router->matchFromPath($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    $parameters = $route->getHandler();
    $controllerName = $parameters[0];
    $arguments = $route->getVarsNames();
    $methodName = $parameters[1] ?? null;
    $db = new Db();
    $controller = new $controllerName($db);
    if (!is_callable($controller)) {
      $controller =  [$controller, $methodName];
    }

    echo $controller(...array_values($arguments));
  }
}
