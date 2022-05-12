<?php

require __DIR__.'/vendor/autoload.php';

use Demo\Logcli\LogClient;

$client = new LogClient('aaa', 'bbb');

while (true) {
    $input = fgets(STDIN);
    $client->send('aaaaa.log', $input);
}