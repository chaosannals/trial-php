<?php

namespace Demo\Logcli;

use Exception;

class LogClient
{
    private $key;
    private $pass;
    private $host;
    private $port;
    private $sock;

    public function __construct($key = '', $pass = '', $host = '127.0.0.1', $port = 22222)
    {
        $this->key = $key;
        $this->pass = $pass;
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

    public function send($filename, $input)
    {
        $kl = strlen($this->key);
        $fnl = strlen($filename);
        $il = strlen($input);
        $head = pack("VVV", $kl, $fnl, $il);
        $buffer = $head.$this->key.$filename.$input;
        $bl = strlen($head) + $kl + $fnl + $il;
        socket_clear_error($this->sock);
        if (socket_sendto($this->sock, $buffer, $bl, 0, $this->host, $this->port) === false) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new Exception("sendto error :" . $errormsg);
        }
    }
}
