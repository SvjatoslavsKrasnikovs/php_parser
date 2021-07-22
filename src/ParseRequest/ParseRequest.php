<?php

namespace RequestHandler;

class ParseRequest
{
    private array $request;
    private bool $isValid;

    function __construct($request) {
        $this->request = $request;
        $this->isValid = false;
    }

    public function getRequest(): array {
        return $this->request;
    }

    public function validateRequest(): void {

    }

    private function setValid(): void {
        $this->isValid = true;
    }
}