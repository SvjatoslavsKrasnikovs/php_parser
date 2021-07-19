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
    return json_encode($request);
});