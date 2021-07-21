<?php
require_once 'Request.php';
require_once 'Router.php';

$request = new Request;

$router = new Router($request);

// Leave this as it is for testing purposes;
$router->get('/', function() {
    phpinfo();
});

// This will be the main route for now;
$router->get('/api/parse_url', function($request) {
    // var_dump($request->getBody());
    // return json_encode($request->getBody());
    header('Content-Type: application/json');
    $arr = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
    echo json_encode($arr); // {"a":1,"b":2,"c":3,"d":4,"e":5}
});