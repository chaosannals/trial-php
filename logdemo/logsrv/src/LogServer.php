<?php

namespace Demo\Logsrv;

use Exception;

class LogServer
{
    // const CRYPT_METHOD = 'aes-256-cbc';

    private $host;
    private $port;
    private $sock;
    private $unpacker;

    public function __construct($host = '0.0.0.0', $port = 22222)
    {
        $this->host = $host;
        $this->port = $port;
        // $this->ivlen = openssl_cipher_iv_length(self::CRYPT_METHOD);
        $this->unpacker = new LogUnpacker();
        $this->sock = socket_create(AF_INET, SOCK_DGRAM, 0);
        if ($this->sock === false) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new Exception($errormsg);
        }
        socket_set_nonblock($this->sock);
        if (!socket_bind($this->sock, $this->host, $this->port)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new Exception($errormsg);
        }
    }

    public function serve()
    {
        $remoteIp = null;
        $remotePort = null;
        while (true) {
            $r = @socket_recvfrom(
                $this->sock,
                $buffer,
                500, // TODO 数据包管理，500
                0,
                $remoteIp,
                $remotePort
            );
            if ($r > 0 and !empty($remoteIp)) {
                // [$key, $now, $filename, $input] = $this->decrypt($buffer);
                [$key, $now, $pc, $id, $filename, $input] = $this->unpacker->unpack($buffer);
                if (empty($id)) {
                    echo "error: [$now] $remoteIp:$remotePort -- $key $pc $filename $input" . PHP_EOL;
                } else {
                    echo "[$now] $remoteIp:$remotePort -- $key $pc $id $filename $input" . PHP_EOL;
                }
                $remoteIp = null;
                $remotePort = null;
                $buffer = null;
            }
        }
    }

    // public function decrypt($b)
    // {
    //     extract(unpack("Vkl/a{$this->ivlen}iv/Et/a32hmac", $b));
    //     $key = substr($b, 60, $kl);
    //     $pass = 'bbb'; // TODO 账号管理
    //     $r = substr($b, 60 + $kl);
    //     $d = openssl_decrypt($r, self::CRYPT_METHOD, $pass, OPENSSL_RAW_DATA, $iv);
    //     $nhmac = hash_hmac('sha256', $r, $pass, true);
    //     if (strcmp($nhmac, $hmac) != 0) {
    //         var_export(base64_encode($nhmac) . '      ' . base64_encode($hmac));
    //         return [$key, $t, null, null];
    //     }
    //     extract(unpack('Eit/Vfnl/Vil', $d));
    //     $filename = substr($d, 16, $fnl);
    //     $input = substr($d, 16 + $fnl);
    //     return [$key, $it, $filename, $input];
    // }
}
