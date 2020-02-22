<?php

// include 加载 php
$start = microtime(true);
for ($i = 1; $i <= 10000; ++$i) {
    $j = ($i % 10) + 1;
    include "./php/$j.php";
}
$interval = microtime(true) - $start;
echo str_pad('include php :', 30) . "{$interval}s" . PHP_EOL;

// file_get_contents 加载 json
$start = microtime(true);
for ($i = 1; $i <= 10000; ++$i) {
    $j = ($i % 10) + 1;
    json_decode(file_get_contents("./json/$j.json"), true);
}
$interval = microtime(true) - $start;
echo str_pad('file_get_contents json:', 30) . "{$interval}s" . PHP_EOL;

// fopen 加载 json
$start = microtime(true);
for ($i = 1; $i <= 10000; ++$i) {
    $j = ($i % 10) + 1;
    $p = "./json/$j.json";
    $f = fopen($p, 'r');
    $c = fread($f, filesize($p));
    json_decode($c, true);
    fclose($f);
}
$interval = microtime(true) - $start;
echo str_pad('fread json:', 30) . "{$interval}s" . PHP_EOL;
