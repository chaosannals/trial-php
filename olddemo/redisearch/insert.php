<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Ehann\RedisRaw\PredisAdapter;
use Ehann\RedisRaw\PhpRedisAdapter;
use Ehann\RedisRaw\RedisClientAdapter;
use Ehann\RediSearch\Index;
use Ehann\RediSearch\Fields\TextField;
use Ehann\RediSearch\Fields\NumericField;

$redis = (new PhpRedisAdapter())
    ->connect('127.0.0.1', 6380);

$bookIndex = new Index($redis, 'tttt1');
// 需要设置字段这个 SDK 设计的问题。
$bookIndex->addTextField('title')
    ->addTextField('author')
    ->addNumericField('price')
    ->addNumericField('stock');

$document = $bookIndex->makeDocument();

$document->title->setValue('a');

$bookIndex->add($document);

$bookIndex->add([
    new TextField('title', 'Tale of Two Cities'),
    new TextField('author', 'Charles Dickens'),
    new NumericField('price', 9.99),
    new NumericField('stock', 231),
]);
