<?php

require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * 交集。
 *
 * @param array $a
 * @param array $b
 * @return void
 */
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

function unique_n_set($a)
{
    $i = 0;
    $result = [];
    $length = count($a);
    sort_n_set($a);
    for ($j = 0; $j < $length; ++$j) {
        if (empty($result)) {
            $result[] = $a[$j];
        } else {
            $c = n_set_cmp($result[$i], $a[$j]);
            if ($c !== 0) {
                $result[] = $a[$j];
                ++$i;
            }
        }
    }
    return $result;
}

$a = random_n_set(10000);
$b = random_n_set(10000);

$r = timing('n set intersect', function () use ($a, $b) {
    sort_n_set($a);
    sort_n_set($b);
    return intersect_n_set($a, $b);
});
echo count($r) . PHP_EOL;

$r2 = timing('n set unique', function () use ($a) {
    return unique_n_set($a);
});
echo count($r2) . PHP_EOL;
