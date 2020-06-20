<?php

$pid = getmypid();

echo "start $pid" . PHP_EOL;
for ($i = 0; $i <= 10; ++$i) {
    sleep(1);
}
echo "end $pid" . PHP_EOL;
