<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once __DIR__ . '/tokenizer.php';

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

$tnt->selectIndex('name.index');
$tnt->setTokenizer(new NameTokenizer());
// 不管输入多少，超过500都只有500条。10000也只有500条。
$tntResult = $tnt->search('名词', 10000);
