<?php

namespace App\Grpc;

use Hyperf\GrpcClient\BaseClient;
use Grpc\HiUser;
use Grpc\HiReply;

class HiClient extends BaseClient
{
    public function sayHello(HiUser $argument)
    {
        return $this->_simpleRequest(
            '/grpc.Hi/SayHello',
            $argument,
            [HiReply::class, 'decode']
        );
    }
}