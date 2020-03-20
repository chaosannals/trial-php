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

function snake_to_kebab($source)
{
    return str_replace('_', '-', $source);
}

function camel_to_snake($source)
{
    return preg_replace_callback('/([A-Z])/', function ($matches) {
        return '_' . strtolower($matches[1]);
    }, $source);
}

function camel_to_kebab($source)
{
    return preg_replace_callback('/([A-Z])/', function ($matches) {
        return '-' . strtolower($matches[1]);
    }, $source);
}

function kebab_to_snake($source)
{
    return str_replace('-', '_', $source);
}

function kebab_to_camel($source)
{
    return preg_replace_callback('/-([a-z])/', function ($matches) {
        return strtoupper($matches[1]);
    }, $source);
}

function in_winnt()
{
    return stripos(PHP_OS, 'win') !== false;
}

function get_phpinfo($what = INFO_ALL)
{
    ob_start();
    phpinfo($what);
    $info = ob_get_contents();
    ob_end_clean();
    return $info;
}

function get_phpini_path()
{
    $info = get_phpinfo(INFO_GENERAL);
    // 匹配命令行的信息。
    preg_match_all('/Configuration\s*File.+?=>\s*(.+?)[\r\n]/', $info, $matches);
    foreach ($matches[1] as $path) {
        if (stripos($path, 'php.ini') !== false) {
            return $path;
        }
    }
    return null;
}
