<?php

namespace Demo\Logcli;

use Exception;

class LogClient
{
    private $host;
    private $port;
    private $sock;

    public function __construct($host='127.0.0.1', $port=22222)
    {
        $this->host = $host;
        $this->port = $port;
        $this->sock = socket_create(AF_INET, SOCK_DGRAM, 0);
        if ($this->sock === false) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new Exception($errormsg);
        }
    }

    public function __destruct()
    {
        if ($this->sock !== false) {
            socket_close($this->sock);
        }
    }

    public function send($data) {

    }

    public function loop() {
        
    }
}
