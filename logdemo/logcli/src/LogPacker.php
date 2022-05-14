<?php

namespace Demo\Logcli;

class LogPacker
{
    const PACK_MAX_SIZE = 500 - 72 - 8 - 16; // 最后的 16 给 AES 对齐预留
    const CRYPT_METHOD = 'aes-256-cbc';

    private $key;
    private $pass;

    public function __construct($key, $pass)
    {
        $this->key = $key;
        $this->pass = $pass;
        $this->ivlen = openssl_cipher_iv_length(self::CRYPT_METHOD);
    }

    public function pack($filename, $input)
    {
        $id = uniqid('', true);
        $idl = strlen($id);
        $now = microtime(true);
        $kl = strlen($this->key);
        $fnl = strlen($filename);
        $il = strlen($input);
        $all = str_split($filename . $input, self::PACK_MAX_SIZE - $idl - $kl);
        $pc = count($all);
        $rs = [];
        foreach ($all as $i => $v) {
            $d = pack("VVa{$idl}a*", $i, $idl, $id, $v);
            $iv = openssl_random_pseudo_bytes($this->ivlen);
            $r = openssl_encrypt($d, self::CRYPT_METHOD, $this->pass, OPENSSL_RAW_DATA, $iv);
            $hm = hash_hmac('sha256', $r, $this->pass, true);
            $rs[] = pack("VVVVa{$this->ivlen}Ea32a{$kl}a*", $pc, $kl, $fnl, $il, $iv, $now, $hm, $this->key, $r);
        }
        return $rs;
    }
}
