<?php

require dirname(__DIR__) . '/vendor/autoload.php';

$da = random_set(1000000);
$db = random_set(1000000);
$la = array_keys($da);
$lb = array_keys($db);

timing('dict_diff', function () use ($da, $db) {
    return array_diff_key($da, $db);
});

timing('list_diff', function () use ($la, $lb) {
    return array_diff($la, $lb);
});

timing('dict_intersect', function () use ($da, $db) {
    return array_intersect_key($da, $db);
});

timing('list_intersect', function () use ($la, $lb) {
    return array_intersect($la, $lb);
});

timing('dict_merge', function () use ($da, $db) {
    return array_merge($da, $db);
});

timing('list_merge', function () use ($la, $lb) {
    return array_merge($la, $lb);
});

timing('dict_save', function () use ($da, $db) {
    save_data(__DIR__ . '/da.txt', $da);
    save_data(__DIR__ . '/db.txt', $db);
});

timing('list_save', function () use ($la, $lb) {
    save_data(__DIR__ . '/la.txt', $la);
    save_data(__DIR__ . '/lb.txt', $lb);
});

timing('dict_load', function () {
    load_data(__DIR__ . '/da.txt');
    load_data(__DIR__ . '/db.txt');
});

timing('list_load', function () {
    load_data(__DIR__ . '/la.txt');
    load_data(__DIR__ . '/lb.txt');
});
