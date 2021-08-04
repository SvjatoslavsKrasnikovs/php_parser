<?php
require '/application/vendor/autoload.php';

use RequestHandler\ParseRequest;
use ResponseHandler\FullResponse;
use Client\ParseCanonicalClient;

$requestBody = file_get_contents('php://input');
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$json_type = json_decode($requestBody, true);

// Primitive router. For now, let's support only a single endpoint and request method
if (($requestMethod === 'POST') && $requestUri === '/api/parse_canonical') {
    // Parse and validate input parameters
    $parser = new ParseRequest($json_type);
    $requestError = $parser->validateRequest();

    // FullResponse object will be in charge of putting together the response
    // Should work no matter if the request is valid or not. In case either of fields are not present,
    $response = new FullResponse($parser->getTargetUrl(), $parser->getToken(), $requestError);

    // Only run the client in case all fields are valid
    if ($parser->getIsValid()) {
        $client = new ParseCanonicalClient($parser->getTargetUrl());
        $response->addFetchResults($client->run());
    }

    header('Content-Type: application/json');
    echo $response->createResponse();



    // TODO: create response in case the parameters are invalid (error)

}