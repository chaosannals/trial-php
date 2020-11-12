<?php

use Hyperf\HttpMessage\Stream\SwooleStream;
use exert\Application;
use exert\Log;
use exert\Redis;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application(__DIR__);
$app->apply();

$app->get('/', function () {
    $user = $this->request->input('user', 'nano');
    $method = $this->request->getMethod();
    Log::get()->info('aaaaa');
    $rks = Redis::get()->keys('*');
    return [
        'message' => "hello {$user}",
        'method' => $method,
        'env' => env('db_host'),
        'conf' => config('redis'),
        'rks' => $rks,
    ];
});

$app->addExceptionHandler(function ($throwable, $response) {
    return $response->withStatus('418')
        ->withBody(new SwooleStream($throwable->getMessage()));
});


$app->run();
