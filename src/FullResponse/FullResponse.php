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
            'request_error' => $this->requestError,
            'results' => json_decode($this->fetchResults, JSON_UNESCAPED_SLASHES),
        );

        return json_encode($response, JSON_UNESCAPED_SLASHES);
    }

    public function setTargetUrl(string $targetUrl)
    {
        $this->targetUrl = $targetUrl;
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }
}
