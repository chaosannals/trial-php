<?php

require dirname(__DIR__) . '/vendor/autoload.php';

// include 加载 php
timing('include:', function () {
    for ($i = 1; $i <= 10000; ++$i) {
        $j = ($i % 10) + 1;
        include __DIR__ . "/php/$j.php";
    }
});

// include_once 加载 php
timing('include_once:', function () {
    for ($i = 1; $i <= 10000; ++$i) {
        $j = ($i % 10) + 1;
        include_once __DIR__ . "/php/$j.php";
    }
});

// require 加载 php
timing('require:', function () {
    for ($i = 1; $i <= 10000; ++$i) {
        $j = ($i % 10) + 1;
        require __DIR__ . "/php/$j.php";
    }
});

// require_once 加载 php
timing('require_once:', function () {
    for ($i = 1; $i <= 10000; ++$i) {
        $j = ($i % 10) + 1;
        require_once __DIR__ . "/php/$j.php";
    }
});

// file_get_contents 加载 json
timing('file_get_contents:', function () {
    for ($i = 1; $i <= 10000; ++$i) {
        $j = ($i % 10) + 1;
        json_decode(file_get_contents(__DIR__ . "/json/$j.json"), true);
    }
});

// fopen 加载 json
timing('fread:', function() {
    for ($i = 1; $i <= 10000; ++$i) {
        $j = ($i % 10) + 1;
        $p = __DIR__."/json/$j.json";
        $f = fopen($p, 'r');
        $c = fread($f, filesize($p));
        json_decode($c, true);
        fclose($f);
    }
});