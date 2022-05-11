<?php

$sock = socket_create(AF_INET, SOCK_DGRAM, 0);
if ($sock === false) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    throw new Exception($errormsg);
}
socket_set_nonblock($sock);

try {
    if (!socket_bind($sock, "0.0.0.0", 22222)) {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
        throw new Exception($errormsg);
    }

    echo 'start'.PHP_EOL;
    $start = microtime(true);
    $remoteIp = null;
    $remotePort = null;
    while (true) {
        $r = @socket_recvfrom(
            $sock, $buf, 512, 0,
            $remoteIp, $remotePort
        );
        if (!empty($remoteIp)) {
            $now = date('Y-m-d H:i:s');
            echo "[$now] $remoteIp:$remotePort -- ".$buf.PHP_EOL;
            socket_sendto(
                $sock, "Ok ", 100, 0,
                $remoteIp, $remotePort
            );
            $remoteIp = null;
            $remotePort = null;
            $buf = null;
        }
    }
}
finally {
    socket_close($sock);
}