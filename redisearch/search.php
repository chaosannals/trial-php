<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Ehann\RedisRaw\PhpRedisAdapter;
use Ehann\RediSearch\Index;

$redis = (new PhpRedisAdapter())
    ->connect('127.0.0.1', 6379);

$bookIndex = new Index($redis);

$result = $bookIndex->search('two');

$count = $result->getCount();     // Number of documents.
$docs = $result->getDocuments(); // Array of matches.

// Documents are returned as objects by default.
$firstResult = $docs[0];
$firstResult->title;
$firstResult->author;

var_export($count);
var_export($docs);
