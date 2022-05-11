<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use Ehann\RedisRaw\PredisAdapter;
use Ehann\RedisRaw\PhpRedisAdapter;
use Ehann\RedisRaw\RedisClientAdapter;
use Ehann\RediSearch\Index;

// $redis = (new PredisAdapter())
//     ->connect('127.0.0.1', 6379);

$redis = (new PhpRedisAdapter())
    ->connect('127.0.0.1', 6380);

// $redis = (new RedisClientAdapter())
//     ->connect('127.0.0.1', 6379);

$bookIndex = new Index($redis, 'tttt1');
// 设置字段
$bookIndex->addTextField('title')
    ->addTextField('author')
    ->addNumericField('price')
    ->addNumericField('stock')
    ->create();

