<?php

namespace RequestHandler;

class ParseRequest
{
    private array $request;
    private bool $isValid;
    const TOKEN = 'someveryverycomplicatedtoken';

    function __construct($request) {
        $this->request = $request;
        $this->isValid = false;
    }

    public function getRequest(): array {
        return $this->request;
    }

    public function validateRequest(): void {
        if (!isset($this->request['url'], $this->request['token'])) {
            return;
        }

        // Simple validation;
        if (!filter_var($this->request['url'], FILTER_VALIDATE_URL)) {
            return;
        }

        // Later on we should actually check this against a registred token;
        if ($this->request['token'] !== self::TOKEN) {
            return;
        }
        $this->setValid();
    }

    private function setValid(): void {
        $this->isValid = true;
    }

    public function getIsValid(): bool {
        return $this->isValid;
    }
}