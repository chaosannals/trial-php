<?php

namespace exert;

use exert\exception\CrypticException;

class Crypter
{
    private $key;
    private $method;
    private $ivlength;

    public function __construct($key, $method = 'aes-256-cbc')
    {
        $this->key = $key;
        $this->method = $method;
        $this->ivlength = openssl_cipher_iv_length($method);
    }

    public function encrypt($data)
    {
        $iv = openssl_random_pseudo_bytes($this->ivlength);
        $text = openssl_encrypt(
            json_encode($data, JSON_UNESCAPED_UNICODE),
            $this->method,
            $this->key,
            OPENSSL_RAW_DATA,
            $iv
        );
        $hmac = hash_hmac('sha256', $text, $this->key, true);
        return base64_encode($iv . $hmac . $text);
    }

    public function decrypt($data)
    {
        $raw = base64_decode($data);
        $iv = substr($raw, 0, $this->ivlength);
        $hmac = substr($raw, $this->ivlength, 32);
        $text = substr($raw, $this->ivlength + 32);
        $result = openssl_decrypt(
            $text,
            $this->method,
            $this->key,
            OPENSSL_RAW_DATA,
            $iv
        );
        $calcmac  = hash_hmac('sha256', $text, $this->key, true);
        if ($hmac != $calcmac) {
            throw new CrypticException("哈希校验有误");
        }
        return json_decode($result, true);
    }
}
