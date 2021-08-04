<?php

namespace ResponseHandler;

class FullResponse
{
    private string $fetchResults;
    private string $targetUrl;
    private string $requestError;
    private string $token;

    function __construct(string $targetUrl, string $token, string $requestError)
    {
        $this->targetUrl = $targetUrl;
        $this->token = $token;
        $this->requestError = $requestError;
        $this->fetchResults = '';
    }

    public function addFetchResults(string $fetchResults): void
    {
        $this->fetchResults = $fetchResults;
    }

    public function createResponse(): string
    {
        $response = array(
            'query' => array(
                'url' => $this->targetUrl,
                'token' => $this->token,
            ),
            'results' => json_decode($this->fetchResults, JSON_UNESCAPED_SLASHES),
        );
        if ($this->requestError !== '') {
            $response['query']['request_error'] = $this->requestError;
        }


        return json_encode($response, JSON_UNESCAPED_SLASHES);
    }
}
