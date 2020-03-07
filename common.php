<?php

function timing($symbol, $callback)
{
    $start = microtime(true);
    $result = $callback();
    $interval = number_format(microtime(true) - $start, 10);
    echo str_pad($symbol, 30) . "{$interval}s" . PHP_EOL;
    return $result;
}

function random_set($length, $min = 1, $max = 100000000)
{
    $result = [];
    while (true) {
        $k = random_int($min, $max);
        if (isset($result[$k])) {
            continue;
        }
        $result[$k] = null;
        if (count($result) >= $length) {
            break;
        }
    }
    return $result;
}

function save_data($path, $data)
{
    $text = serialize($data);
    file_put_contents($path, $text);
}

function load_data($path)
{
    $text = file_get_contents($path);
    return unserialize($text);
}

function snake_to_camel($source)
{
    return preg_replace_callback('/_([a-z])/', function ($matches) {
        return strtoupper($matches[1]);
    }, $source);
}

function camel_to_snake($source)
{
    return preg_replace_callback('/([A-Z])/', function ($matches) {
        return '_' . strtolower($matches[1]);
    }, $source);
}
