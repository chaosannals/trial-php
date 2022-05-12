<?php

require __DIR__.'/vendor/autoload.php';

use Demo\Logsrv\LogServer;

$server = new LogServer();
$server->serve();
