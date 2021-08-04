<?php

namespace Client;

use \Kicken\Gearman\Client;

class ParseCanonicalClient {
    private string $url;
    function __construct(string $url) {
        $this->url = $url;
    }

    public function run(): string {
        $client = new Client('gearmand:4730');
        $job = $client->submitJob('rot13', $this->url);
        $client->wait();
        return $job->getResult();
    }
}