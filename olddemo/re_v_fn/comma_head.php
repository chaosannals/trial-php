<?php
require dirname(__DIR__) . '/vendor/autoload.php';

$text = '中文,English,1233,454';

timing('explode:', function () use ($text) {
    $a = explode(',', $text);
    $b = array_splice($a, 0, 2);
    return implode(',', $b);
});

timing('explode for:', function () use ($text) {
    $result = [];
    for ($i = 0; $i < 10000; ++$i) {
        $a = explode(',', $text);
        $b = array_splice($a, 0, 2);
        $result[] = implode(',', $b);
    }
    return $result;
});

timing('regex:', function () use ($text) {
    if (preg_match('/(.+?,.+?),.+/u', $text, $m)) {
        return $m[1];
    } else {
        return $text;
    }
});

timing('regex for:', function () use ($text) {
    $result = [];
    for ($i = 0; $i < 10000; ++$i) {
        if (preg_match('/(.+?,.+?),.+/u', $text, $m)) {
            $result[] = $m[1];
        } else {
            $result[] = $text;
        }
    }
    return $result;
});

timing('regex:', function () use ($text) {
    if (preg_match('/(.+?,.+?),.+/u', $text, $m)) {
        return $m[1];
    } else {
        return $text;
    }
});
