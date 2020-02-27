<?php

function timing($symbol, $callback)
{
    $start = microtime(true);
    $callback();
    $interval = microtime(true) - $start;
    echo str_pad($symbol, 30)."{$interval}s" . PHP_EOL;
}
