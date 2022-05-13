<?php

namespace Demo\Logcli;

use Exception;

class LogClient
{
    const CRYPT_METHOD = 'aes-256-cbc';

    private $key;
    private $pass;
    private $host;
    private $port;
    private $sock;

    public function __construct($key, $pass, $host = '127.0.0.1', $port = 22222)
    {
        $this->key = $key;
        $this->pass = $pass;
        $this->host = $host;
        $this->port = $port;
        $this->ivlen = openssl_cipher_iv_length(self::CRYPT_METHOD);
        $this->sock = socket_create(AF_INET, SOCK_DGRAM, 0);
        if ($this->sock === false) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new Exception($errormsg);
        }
    }

    public function __destruct()
    {
        if ($this->sock !== false) {
            socket_close($this->sock);
        }
    }

    public function send($filename, $input)
    {
        $b = $this->encrypt($filename, $input);
        socket_clear_error($this->sock);
        if (socket_sendto($this->sock, $b, strlen($b), 0, $this->host, $this->port) === false) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new Exception("sendto error :" . $errormsg);
        }
    }

    public function encrypt($filename, $input)
    {
        $now = microtime(true);
        $iv = openssl_random_pseudo_bytes($this->ivlen);
        $fnl = strlen($filename);
        $il = strlen($input);
        $data = pack("EVVa{$fnl}a{$il}", $now, $fnl, $il, $filename, $input);
        $r = openssl_encrypt($data, self::CRYPT_METHOD, $this->pass, OPENSSL_RAW_DATA, $iv);
        $hm = hash_hmac('sha256', $r, $this->pass, true);
        $kl = strlen($this->key);
        $h = pack("Va{$this->ivlen}Ea32", $kl, $iv, $now, $hm);
        $b = $h . $this->key . $r;
        return $b;
    }
}
