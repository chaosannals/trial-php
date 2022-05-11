<?php require dirname(__DIR__) . '/vendor/autoload.php';

timing('make', function() {
    $inipath = get_phpini_path();
    $folder = dirname($inipath);
    $cnfpath = join(DIRECTORY_SEPARATOR, [
        $folder,
        'extras',
        'ssl',
        'openssl.cnf',
    ]);
    $pkey = openssl_pkey_new([
        'config' => $cnfpath
    ]);
    if (empty($pkey)) {
        echo openssl_error_string();
    }
    $path = __DIR__.'/pkey.txt';
    openssl_pkey_export_to_file($pkey, $path, null, [
        'config' => $cnfpath,
    ]);
});