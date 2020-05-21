<?php

$result = [];
for ($i = 0; $i <= 1000000; ++$i) {
    $result[] = random_int(1, 100000000);
    if (!($i % 10000)) {
        echo 'now:' . memory_get_usage() . PHP_EOL;
        echo 'peak:' . memory_get_peak_usage() . PHP_EOL;
    }
}
