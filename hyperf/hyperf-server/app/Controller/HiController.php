<?php
namespace App\Controller;

use Grpc\HiUser;
use Grpc\HiReply;

// 9503 server
class HiController extends AbstractController {
    public function sayHello(HiUser $user) 
    {
        $message = new HiReply();
        $message->setMessage("Hello World");
        $message->setUser($user);
        $file = $user->getFile();
        // file_put_contents(__DIR__.'/test.bin', $file);
        $type = gettype($file);
        $this->logger->debug("type: $type");
        return $message;
    }
}