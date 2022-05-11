<?php

$p = proc_open('php loop.php', [
    ['pipe', 'r'],
    ['pipe', 'w'],
    ['pipe', 'w'],
], $pipes, __DIR__);

$start = microtime(true);
while (is_resource($p)) {
    $text = fread($pipes[1], 1000);
    if (!empty($text)) {
        echo "i: [$text]" . PHP_EOL;
    }

    $stat = proc_get_status($p);
    if ($stat['running'] == false) {
        $error = fread($pipes[2], 1000);
        if (!empty($error)) {
            echo "e: [$error]" . PHP_EOL;
        }
        fclose($pipes[0]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($p);
        break;
    }
    $t = microtime(true) - $start;
    echo "wait: {$t}s" . PHP_EOL;
    sleep(1);
}
