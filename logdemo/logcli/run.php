<?php

$host = "127.0.0.1";
$port = 22222;

$sock = socket_create(AF_INET, SOCK_DGRAM, 0);
if ($sock === false) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    throw new Exception($errormsg);
}
socket_set_nonblock($sock);
socket_clear_error($sock);

while (true) {
    $input = fgets(STDIN);

    // $input = "11111";

    if (socket_sendto($sock, $input, strlen($input), 0, $host, $port) === false) {
        $errorcode = socket_last_error();
        $errormsg = socket_strerror($errorcode);
        echo "sendto error :".$errormsg.PHP_EOL;
    }

    if (socket_recv($sock, $reply, 2048, 0) === false) {
        $errorcode = socket_last_error();
        if ($errorcode != 10035) {
            $errormsg = socket_strerror($errorcode);
            socket_clear_error($sock);
            echo "recv error $errorcode :".$errormsg.PHP_EOL;
        }
    }

    echo "reply: ".$reply.PHP_EOL;
}
