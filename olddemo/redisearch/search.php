<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Ehann\RedisRaw\PhpRedisAdapter;
use Ehann\RediSearch\Index;

$redis = (new PhpRedisAdapter())
    ->connect('127.0.0.1', 6380);

$bookIndex = new Index($redis, 'tttt1');

$result = $bookIndex->search('Charles');

$count = $result->getCount();     // Number of documents.
$docs = $result->getDocuments(); // Array of matches.


if ($count > 0) {
    $firstResult = $docs[0];
    $firstResult->title;
    $firstResult->author;
}

var_export($count);
var_export($docs);
