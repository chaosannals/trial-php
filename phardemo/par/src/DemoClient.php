<?php

namespace Demo\Par;

use Demo\Par\Lib\DemoLib;
use Demo\Par\Errdir\ErrorDir;
use WpOrg\Requests\Requests;
use GuzzleHttp\Client;

class DemoClient
{
    private $client;
    private $lib;

    public function __construct()
    {
        $this->client = new Client();
        $this->lib = new DemoLib();
    }

    public function call()
    {
        $response = $this->client->request('GET', 'https://baidu.com');
        echo $response->getStatusCode();
        echo $response->getHeaderLine('content-type');
        // echo $response->getBody();
    }

    public function callR()
    {
        $response = Requests::get("http://baidu.com", [], [
            'timeout' => 30000,
        ]);
        echo $response->status_code;
        echo $response->headers->offsetGet('Content-Type');
    }

    public function doSome()
    {
        $this->lib->doSome();
    }

    public function doByErrorDir()
    {
        $ed = new ErrorDir();
        $ed->doError();
    }
}
