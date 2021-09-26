<?php


include_once "db/connect.php";
include_once 'inetrfaces/RequestInterface.php';
include_once 'classes/Env.php';
include_once 'classes/Request.php';
include_once 'classes/Router.php';
include_once 'controllers/Controller.php';
include_once 'controllers/ProductController.php';
use Utils\Env;

$router = new Router(new Request);
(new Env(__DIR__ . '/.env'));

$router->get('/', function() {
  $controller = new ProductController();
  $controller->getAll();
});


$router->get('/profile', function($request) {
  return <<<HTML
  <h1>Profile</h1>
HTML;
});

$router->post('/data', function($request) {

  return json_encode($request->getBody());
});

// $db = new Db("localhost" , "root" , "asd@asd@" , "scandiweb_products");
// $db = $db->connect();
// $result = $db->query("call GetProducts()");
// if($result){
//     echo json_encode($result->fetch_all(MYSQLI_ASSOC));
//     $result->close();
// }
// $db->close();
