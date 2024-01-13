<?php
namespace App\Controller;

use Grpc\HiUser;
use Grpc\HiReply;

class HiController extends AbstractController {
    public function sayHello(HiUser $user) 
    {
        $message = new HiReply();
        $message->setMessage("Hello World");
        $message->setUser($user);
        return $message;
    }
}