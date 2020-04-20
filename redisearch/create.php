<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use Ehann\RedisRaw\PredisAdapter;
use Ehann\RedisRaw\PhpRedisAdapter;
use Ehann\RedisRaw\RedisClientAdapter;
use Ehann\RediSearch\Index;
use Ehann\RediSearch\Fields\TextField;
use Ehann\RediSearch\Fields\NumericField;

// $redis = (new PredisAdapter())
//     ->connect('127.0.0.1', 6379);

$redis = (new PhpRedisAdapter())
    ->connect('127.0.0.1', 6379);

// $redis = (new RedisClientAdapter())
//     ->connect('127.0.0.1', 6379);

$bookIndex = new Index($redis);

$bookIndex->addTextField('title')
    ->addTextField('author')
    ->addNumericField('price')
    ->addNumericField('stock')
    ->create();

$bookIndex->add([
    new TextField('title', 'Tale of Two Cities'),
    new TextField('author', 'Charles Dickens'),
    new NumericField('price', 9.99),
    new NumericField('stock', 231),
]);
