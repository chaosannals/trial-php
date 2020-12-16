<?php

use Swlib\SaberGM;

require __DIR__ . '/vendor/autoload.php';

while (true) {
    go(function () {
        echo SaberGM::get('http://swoole-http-server:9501/');
    });
    sleep(10);
}
