<?php

require "vendor/autoload.php";

use GuzzleHttp\Client;
class ConsumingApi {
    private $client;
    private $base_url;
    private $headers;
    private $auth;

    public function __construct () {
        $this->client = new Client();
        $this->base_url = 'https://api.github.com';
        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];
        $this->auth = ['username', 'password'];
    }

    public function getData () {
        return $this->client->request('GET', $this->base_url, [
            $this->headers, $this->auth
        ])->getBody();
    }

    public function saveOnFile ($filename) {
        $fopen = fopen($filename, "a+");
        fwrite($fopen, $this->getData());
        fclose($fopen);
    }
}

$api = new ConsumingApi();
echo $api->saveOnFile("arquivo.txt");