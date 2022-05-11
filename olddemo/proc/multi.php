<?php

$ps = [];
$pipes = [];
$start = microtime(true);

for ($i = 0; $i < 100; ++$i) {
    $pipes[$i] = [];
    $ps[] = proc_open('php tick.php', [
        ['pipe', 'r'],
        ['pipe', 'w'],
        ['pipe', 'w'],
    ], $pipes[$i], __DIR__);
}

$t = microtime(true) - $start;
echo "start: {$t}s" . PHP_EOL;

$final = 0;
while ($final < 100) {
    for ($i = 0; $i < 100; ++$i) {
        $p = $ps[$i];
        $pipe = $pipes[$i];
        if (is_resource($p)) {
            $text = fread($pipe[1], 1000);
            if (!empty($text)) {
                echo "i: [$text]" . PHP_EOL;
            }

            // 获取状态准备跳出
            $stat = proc_get_status($p);
            if ($stat['running'] == false) {
                $error = fread($pipe[2], 1000);
                if (!empty($error)) {
                    echo "e: [$error]" . PHP_EOL;
                }
                fclose($pipe[0]);
                fclose($pipe[1]);
                fclose($pipe[2]);
                proc_close($p);
                echo "($i) final." . PHP_EOL;
                ++$final;
                break;
            }
            $t = microtime(true) - $start;
            echo "({$i}) wait: {$t}s" . PHP_EOL;
        }
    }
    sleep(1);
}
