<?php
use exert\Application;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application(__DIR__);
$app->apply();

$app->get('/', function () {
    $user = $this->request->input('user', 'nano');
    $method = $this->request->getMethod();
    return [
        'message' => "hello {$user}",
        'method' => $method,
        'env' => env('db_host'),
        'conf' => config('redis'),
    ];
});

$app->run();