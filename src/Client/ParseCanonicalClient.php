<?php

namespace Client;

class ParseCanonicalClient {
    private string $url;
    function __construct(string $url) {
        $this->url = $url;
    }

    public function run(): string {
        $client = new \Kicken\Gearman\Client('127.0.0.1:4730');
        $job = $client->submitJob('rot13', 'Foobar');
        $client->wait();
        return 'LOL';
    }
}