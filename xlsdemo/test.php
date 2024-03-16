<?php

require __DIR__.'/vendor/autoload.php';

$res_dir = __DIR__."/res";
$pattern = "{$res_dir}/*.xls*";
echo $res_dir.PHP_EOL;
echo $pattern.PHP_EOL;

$xlsFiles = glob($pattern);

// ini_set('display_errors', false);
set_error_handler(function($code, $string, $file, $line) {
    echo 'ERROR'.PHP_EOL;
});
register_shutdown_function(function(){
    echo 'SHUTDOWN'.PHP_EOL;
    $error = error_get_last();
    var_export($error);
});

foreach($xlsFiles as $file) {
    echo $file.PHP_EOL;
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file);
    $reader->load($file);
}