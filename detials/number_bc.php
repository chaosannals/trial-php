<?php

$a = '5.888';
$b = '6.891';

$c = bcmul($a, $b, 10);
$d = bcmul($a, $b);
echo $c.PHP_EOL;
echo $d.PHP_EOL;