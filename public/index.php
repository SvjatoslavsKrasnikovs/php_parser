<?php
require '/application/vendor/autoload.php';

use RequestHandler\ParseRequest;

$requestBody = file_get_contents('php://input');
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$json_type = json_decode($requestBody, true);

// Primitive router. For now, let's support only a single endpoint and request method
if (($requestMethod === 'POST') && $requestUri === '/api/parse_page') {
    // TODO: validate input parameters
    $parser = new ParseRequest($json_type);

    // TODO: create response in case the parameters are invalid (error)


    // TODO: once parameters are valid start client
    header('Content-Type: application/json');
    echo json_encode($json_type);
}

/*$factory = new RandomLib\Factory;
$generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
$bytes = $generator->generate(32);
echo $bytes;*/