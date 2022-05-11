<?php

$sock = socket_create(AF_INET, SOCK_DGRAM, 0);
if ($sock === false) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    throw new Exception($errormsg);
}

try {
    if (!socket_bind($sock, "0.0.0.0", 22222)) {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
        throw new Exception($errormsg);
    }

    echo 'start'.PHP_EOL;

    while (true) {
        $r = socket_recvfrom(
            $sock, $buf, 512, 0,
            $remoteIp, $remotePort
        );
        echo "$remoteIp:$remotePort -- ".$buf.PHP_EOL;
        socket_sendto(
            $sock, "Ok ", 100, 0,
            $remoteIp, $remotePort
        );
    }
}
finally {
    socket_close($sock);
}