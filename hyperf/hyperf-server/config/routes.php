<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::addRoute(['GET', 'POST', 'HEAD'], '/say-ip', 'App\Controller\IndexController@sayIp');


Router::addRoute(['GET', 'POST', 'HEAD'], '/hello', 'App\Controller\GrpcController@hello');


Router::get('/favicon.ico', function () {
    return '';
});

Router::addServer('grpc', function () {
    Router::addGroup('/grpc.Hi', function () {
        Router::post('/SayHello', 'App\Controller\HiController@sayHello');
    });
});