<?php

namespace Demo\Logsrv;

class LogUnpacker
{
    const CRYPT_METHOD = 'aes-256-cbc';

    private $packs;
    private $ivlen;
    private $accounts;

    public function __construct(LogAccounts $accounts)
    {
        $this->packs = [];
        $this->ivlen = openssl_cipher_iv_length(self::CRYPT_METHOD);
        $this->accounts = $accounts;
    }

    public function unpack($pack)
    {
        $up1 = @unpack("Vpc/Vkl/Vfnl/Vil/a{$this->ivlen}iv/Et/a32hmac/a*b", $pack);
        if ($up1 === false) {
            return [null, null, null, null, null, null];
        }
        extract($up1);
        $key = substr($b, 0, $kl);
        $pass = $this->accounts->getPass($key);
        $r = substr($b, $kl);

        $d = openssl_decrypt($r, self::CRYPT_METHOD, $pass, OPENSSL_RAW_DATA, $iv);

        $up2 = @unpack("Vi/Vidl/a*idnv", $d);
        if ($up2 === false) {
            return [$key, $t, $pc, null, null, null];
        }
        extract($up2);
        $nhmac = hash_hmac('sha256', $r, $pass, true);
        if (strcmp($nhmac, $hmac) != 0) {
            echo base64_encode($nhmac) . '   ' . base64_encode($hmac) . PHP_EOL;
            return [$key, $t, $pc, null, null, null];
        }
        $id = substr($idnv, 0, $idl);
        $v = substr($idnv, $idl);

        // 单个包
        if ($pc == 1) {
            $filename = substr($v, 0, $fnl);
            $input = substr($v, $fnl);
            return [$key, $t, $pc, $id, $filename, $input];
        }

        if (empty($this->packs[$id])) {
            $this->packs[$id] = [];
        }
        $this->packs[$id][] = [
            'time' => $t,
            'filename_length' => $fnl,
            'input_length' => $il,
            'count' => $pc,
            'no' => $i,
            'data' => $v,
        ];
        if (count($this->packs[$id]) == $pc) {
            uasort($this->packs[$id], function ($a, $b) {
                return $a['no'] - $b['no'];
            });
            $vs = array_column($this->packs[$id], 'data');
            $vd = join($vs);
            $filename = substr($vd, 0, $fnl);
            $input = substr($vd, $fnl);
            unset($this->packs[$id]);
            return [$key, $t, $pc, $id, $filename, $input];
        }

        return [$key, $t, $pc, $id, null, null];
    }
}
