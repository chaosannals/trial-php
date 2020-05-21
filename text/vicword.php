<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Lizhichao\Word\VicWord;

$fc = new VicWord('json');
$arr = $fc->getAutoWord('北京大学生喝进口红酒，在北京大学生活区喝进口红酒');
var_export($arr);