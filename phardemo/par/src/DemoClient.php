<?php

namespace Demo\Par;

use WpOrg\Requests\Requests;
use GuzzleHttp\Client;

class DemoClient {
    private $client;

    public function __construct()
    {
        $this->client = new Client();

    }

    public function call() {
        $response = $this->client->request('GET', 'https://baidu.com');
        echo $response->getStatusCode();
        echo $response->getHeaderLine('content-type');
        // echo $response->getBody();
    }

    public function callR() {
        $response = Requests::get("http://baidu.com", [
        ], [
            'timeout' => 30000,
        ]);
        echo $response->status_code;
        echo $response->headers->offsetGet('Content-Type');
    }
}