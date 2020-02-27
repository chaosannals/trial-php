<?php

function timing($symbol, $callback)
{
    $start = microtime(true);
    $result = $callback();
    $interval = number_format(microtime(true) - $start, 10);
    echo str_pad($symbol, 30)."{$interval}s" . PHP_EOL;
    return $result;
}
