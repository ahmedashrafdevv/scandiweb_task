<?php

include_once 'inetrfaces/RequestInterface.php';
include_once 'classes/Request.php';
include_once 'classes/Router.php';
$router = new Router(new Request);

$router->get('/', function() {
  return <<<HTML
  <h1>Hello world</h1>
HTML;
});


$router->get('/profile', function($request) {
  return <<<HTML
  <h1>Profile</h1>
HTML;
});

$router->post('/data', function($request) {

  return json_encode($request->getBody());
});

// require_once("db/connect.php");
// $db = new Db("localhost" , "root" , "asd@asd@" , "scandiweb_products");
// $db = $db->connect();
// $result = $db->query("call GetProducts()");
// if($result){
//     echo json_encode($result->fetch_all(MYSQLI_ASSOC));
//     $result->close();
// }
// $db->close();
