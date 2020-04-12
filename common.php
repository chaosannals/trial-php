<?php

/**
 * 计算时间。
 * 
 */
function timing($symbol, $callback)
{
    $start = microtime(true);
    $result = $callback();
    $interval = number_format(microtime(true) - $start, 10);
    echo str_pad($symbol, 30) . "{$interval}s" . PHP_EOL;
    return $result;
}

/**
 * 生成随机集合数据。
 * 
 */
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

/**
 * 保存数据为序列化。
 * 
 */
function save_data($path, $data)
{
    $text = serialize($data);
    file_put_contents($path, $text);
}

/**
 * 加载序列化的数据。
 * 
 */
function load_data($path)
{
    $text = file_get_contents($path);
    return unserialize($text);
}

/**
 * 判断是不是 windows 系统
 * 
 */
function in_winnt()
{
    return stripos(PHP_OS, 'win') !== false;
}

/**
 * 获取 phpinfo 的信息。
 * 
 */
function get_phpinfo($what = INFO_ALL)
{
    ob_start();
    phpinfo($what);
    $info = ob_get_contents();
    ob_end_clean();
    return $info;
}

/**
 * 命令行下获取 php.ini 路径
 */
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
