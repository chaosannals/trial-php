<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once __DIR__ . '/tokenizer.php';

use NumberTokenizer;
use NameTokenizer;
use TeamTNT\TNTSearch\Stemmer\PorterStemmer;
use TeamTNT\TNTSearch\TNTSearch;

$storagePath = __DIR__ . '/index/';
if (!is_dir($storagePath)) {
    mkdir($storagePath, 777, true);
}
$tnt = new TNTSearch();
$tnt->loadConfig([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'trial',
    'username' => 'admin',
    'password' => 'admin',
    'storage' => $storagePath,
    'stemmer' => PorterStemmer::class,
]);

// 名字索引
$indexer = $tnt->createIndex('name.index');
$indexer->setTokenizer(new NameTokenizer());
$indexer->query('SELECT `id`, `name` FROM t_document');
$indexer->run();

// 号码索引
$indexer = $tnt->createIndex('number.index');
$indexer->setTokenizer(new NumberTokenizer());
$indexer->query('SELECT `id`, `number` FROM t_document');
$indexer->run();
