<?php
require dirname(__DIR__) . '/vendor/autoload.php';

function random_password($length=20)
{
    $set = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM-';
    $c = strlen($set);
    $r = [];
    for ($i = 0; $i < $length; ++$i) {
        $r[] = $set[random_int(0, $c - 1)];
    }
    return join($r);
}

timing(':', function () {
    echo random_password();
});
