<?php

$phar = new Phar('par.phar');
$phar->startBuffering();
$phar->buildFromDirectory(__DIR__, '/.php$/');
$phar->compressFiles(Phar::GZ);
$phar->setStub($phar->createDefaultStub('vendor/autoload.php'));
$phar->stopBuffering();
