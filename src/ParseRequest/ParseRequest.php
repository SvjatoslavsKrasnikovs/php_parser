<?php

namespace RequestHandler;

/*This class is in charge of parsing the incomming HTTP requests and validating the body of the request; */
class ParseRequest
{
    private string $token;
    private string $targetUrl;
    public array $request;
    private bool $isValid;
    const TOKEN = 'someveryverycomplicatedtoken';

    function __construct($request) {
        $this->request = $request;
        $this->isValid = false;
        $this->targetUrl = '';
        $this->token = '';
    }

    public function getRequest(): array {
        return $this->request;
    }

    public function validateRequest(): string {
        $err = '';
        if (!isset($this->request['url'])) {
            $err = 'Expected field not present: url';
        } else {
            // Simple validation of URL;
            if (!filter_var($this->request['url'], FILTER_VALIDATE_URL)) {
                $err = 'Invalid URL';
            }
            $this->setTargetUrl($this->request['url']);
        }

        if (!isset($this->request['token'])) {
            $err = 'Expected field not present: token';
        } else {
            // Later on we should actually check this against a registred token;
            if ($this->request['token'] !== self::TOKEN) {
                $err = 'Invalid token';
            }
            $this->setToken($this->request['token']);
        }

        if ($err == '') {
            $this->setValid();
        }

        return $err;
    }

    private function setToken(string $token): void {
        $this->token = $token;
    }

    public function getToken(): string {
        return $this->token;
    }

    private function setTargetUrl(string $targetUrl): void {
        $this->targetUrl = $targetUrl;
    }

    public function getTargetUrl(): string {
        return $this->targetUrl;
    }

    private function setValid(): void {
        $this->isValid = true;
    }

    public function getIsValid(): bool {
        return $this->isValid;
    }
}