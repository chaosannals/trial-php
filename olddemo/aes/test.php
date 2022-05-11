<?php

require dirname(__DIR__) . '/vendor/autoload.php';

// 计算时间
timing('aes 256:', function () {
    $method = "aes-256-cbc";
    $content = ['aaaaaaaaaaa'];
    $account = 'account';
    $secret = 'secret';
    for ($i = 1; $i <= 10000; ++$i) {
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);
        $a = openssl_encrypt(json_encode($content), $method, md5($account . $secret), OPENSSL_RAW_DATA, $iv);
        $b = openssl_decrypt($a, $method, md5($account . $secret), OPENSSL_RAW_DATA, $iv);
        $c = json_decode($b, true);
    }
});
