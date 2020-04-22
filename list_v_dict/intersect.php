<?php

require dirname(__DIR__) . '/vendor/autoload.php';

function random_n_set($length, $n = 5, $min = 1, $max = 10)
{
    $result = [];
    for ($j = 0; $j < $length; ++$j) {
        $v = [];
        for ($i = 0; $i < $n; ++$i) {
            $v[] = random_int($min, $max);
        }
        $result[] = $v;
    }
    return $result;
}

function n_set_cmp($a, $b, $n = 5)
{
    for ($i = 0; $i < $n; ++$i) {
        if ($a[$i] < $b[$i]) {
            return -1;
        } elseif ($a[$i] > $b[$i]) {
            return 1;
        }
    }
    return 0;
}

function sort_n_set(&$n)
{
    return usort($n, 'n_set_cmp');
}

function intersect_n_set($a, $b)
{
    $i = 0;
    $j = 0;
    $ac = count($a);
    $bc = count($b);
    $result = [];
    while ($i < $ac && $j < $bc) {
        $c = n_set_cmp($a[$i], $b[$j]);
        if ($c < 0) {
            ++$i;
        } elseif ($c > 0) {
            ++$j;
        } else {
            $result[] = $a[$i];
            ++$i;
            ++$j;
        }
    }
    return $result;
}

$a = random_n_set(10000);
$b = random_n_set(10000);

$r = timing('n set intersect', function () use (&$a, &$b) {
    sort_n_set($a);
    sort_n_set($b);
    return intersect_n_set($a, $b);
});

var_export(count($r));
