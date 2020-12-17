<?php

use Swlib\SaberGM;

require __DIR__ . '/vendor/autoload.php';

while (true) {
    go(function () {
        $info = SaberGM::get('http://swoole-http-server:9501/');
        error_log($info, 3, 'http.log');
    });
    error_log('tick', 3, 'http.log');
    sleep(10);
}
