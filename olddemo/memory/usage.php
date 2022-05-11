<?php require dirname(__DIR__) . '/vendor/autoload.php';

$all = [];
for ($i = 0; $i < 20; ++$i) {
    $all[] = random_password(1000000);
    echo memory_get_usage().PHP_EOL;
}

echo 'peak: '.memory_get_peak_usage().PHP_EOL;