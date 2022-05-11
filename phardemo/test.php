<?php

require __DIR__.'/par/par.phar';

use Demo\Par\DemoClient;

$dc = new DemoClient();
$dc->call();
