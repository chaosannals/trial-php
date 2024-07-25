<?php

$server = new Swoole\Server("0.0.0.0", 9504, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

$server->on('Packet', function ($server, $data, $clientInfo) {
    $server->sendTo($clientInfo['address'], $clientInfo['port'], "Server ".$data);
    var_dump($clientInfo);
});

$server->start();