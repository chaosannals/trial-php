<?php

namespace Demo\Logsrv;

use Exception;

class LogServer
{
    private $host;
    private $port;
    private $sock;

    public function __construct($host = '0.0.0.0', $port = 22222)
    {
        $this->host = $host;
        $this->port = $port;
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
                $this->sock, $buf, 1024, 0,
                $remoteIp, $remotePort
            );
            if ($r > 0 and !empty($remoteIp)) {
                $now = date('Y-m-d H:i:s');
                extract(unpack("Vkl/Vfnl/Vil", $buf));
                $key = substr($buf, 12, $kl);
                $filename = substr($buf, 12 + $kl, $fnl);
                $input = substr($buf, 12 + $kl + $fnl, $il);
                echo "[$now] $remoteIp:$remotePort -- $key $filename $input".PHP_EOL;
                $remoteIp = null;
                $remotePort = null;
                $buf = null;
            }
        }
    }
}
