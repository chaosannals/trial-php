<?php

echo "start" . PHP_EOL;
for ($i = 0; $i <= 10; ++$i) {
    sleep(2);
    echo "tick $i" . PHP_EOL;
    if (random_int(1, 10) < 3) {
        throw new Exception();
    }
    if (random_int(1, 10) < 3) {
        trigger_error("eeeeeee", E_USER_ERROR);
    }
}
echo "end" . PHP_EOL;
