<?php

namespace exert;

use Swoole\Http\Server;

class App
{
    private $server;

    public function __construct($port = 9501)
    {
        $this->server = new Server("0.0.0.0", $port);
    }

    public function start()
    {
        $this->server->start();
    }
}
