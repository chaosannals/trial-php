<?php

namespace Demo\Logsrv;

use Exception;

class LogServer
{
    private $host;
    private $port;
    private $sock;
    private $unpacker;

    public function __construct($host = '0.0.0.0', $port = 22222)
    {
        $this->host = $host;
        $this->port = $port;
        $this->unpacker = new LogUnpacker(new LogAccountsDefault());
        $this->sock = socket_create(AF_INET, SOCK_DGRAM, 0);
        if ($this->sock === false) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new Exception($errormsg);
        }
        socket_set_nonblock($this->sock);
        if (!socket_bind($this->sock, $this->host, $this->port)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new Exception($errormsg);
        }
    }

    public function serve()
    {
        $remoteIp = null;
        $remotePort = null;
        while (true) {
            $r = @socket_recvfrom(
                $this->sock,
                $buffer,
                500,
                0,
                $remoteIp,
                $remotePort
            );
            if ($r > 0 and !empty($remoteIp)) {
                [$key, $now, $pc, $id, $filename, $input] = $this->unpacker->unpack($buffer);
                if (empty($id)) {
                    echo "error: [$now] $remoteIp:$remotePort -- $key $pc $filename $input" . PHP_EOL;
                } else {
                    echo "[$now] $remoteIp:$remotePort -- $key $pc $id $filename $input" . PHP_EOL;
                }
                $remoteIp = null;
                $remotePort = null;
                $buffer = null;
            }
        }
    }
}
