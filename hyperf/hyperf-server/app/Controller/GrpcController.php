<?php

namespace App\Controller;

use App\Grpc\HiClient;
use Grpc\HiUser;

class GrpcController extends AbstractController {

    // 9501 client
    public function hello()
    {
        // 这个client是协程安全的，可以复用
        $client = new HiClient('127.0.0.1:9503', [
            'credentials' => null,
        ]);
    
        $request = new HiUser();
        $request->setName('hyperf');
        $request->setFile(file_get_contents(__FILE__));
        $request->setSex(1);
    
        /**
         * @var \Grpc\HiReply $reply
         */
        list($reply, $status) = $client->sayHello($request);
    
        $message = $reply->getMessage();
        $user = $reply->getUser();
        
        var_dump(memory_get_usage(true));
        return $message;
    }
}