<?php

$server = new Swoole\Server("0.0.0.0", 9503);

file_put_contents('php://stdout', "start tcp server.");

$server->on('connect', function ($server, $fd){
    echo "connection open: {$fd}\n";
});

$server->on('receive', function ($server, $fd, $reactor_id, $data) {
    $info = $server->getClientInfo($fd);
    file_put_contents('php://stdout', var_export($info,true));
    $server->send($fd, "Swoole: {$data}");
    $server->close($fd);
});

$server->on('close', function ($server, $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();