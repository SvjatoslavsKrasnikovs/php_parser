<?php
require '/application/vendor/autoload.php';

use RequestHandler\ParseRequest;
use Client\ParseCanonicalClient;

$requestBody = file_get_contents('php://input');
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$json_type = json_decode($requestBody, true);

// Primitive router. For now, let's support only a single endpoint and request method
if (($requestMethod === 'POST') && $requestUri === '/api/parse_canonical') {
    // TODO: validate input parameters
    $parser = new ParseRequest($json_type);
    $parser->validateRequest();

    // TODO: once parameters are valid start client
    $client = new ParseCanonicalClient($json_type['url']);
    $client->run();


    // TODO: create response in case the parameters are invalid (error)
    header('Content-Type: application/json');

    if (!$parser->getIsValid()) {
        $errorResponse = array('error' => 'Invalid request');
        echo json_encode($errorResponse);
    } else {
        $successResponse = array(
            'url' => $json_type['url'],
            'token' => $json_type['token'],
        );
        echo json_encode($successResponse, JSON_UNESCAPED_SLASHES);
    }

}

/*$factory = new RandomLib\Factory;
$generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
$bytes = $generator->generate(32);
echo $bytes;*/