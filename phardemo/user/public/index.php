<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../../par/par.phar';

use GuzzleHttp\Client;
use Demo\Par\DemoClient;

echo "<div>本项目 Composer 调用 旧版本 GuzzelHttp </div>";
$client = new Client();
$response = $client->request('GET', 'https://baidu.com');

echo $response->getStatusCode();
echo $response->getHeaderLine('content-type');

echo "<div> par.phar 包调用 新版本 GuzzelHttp </div>";

$dc = new DemoClient();
$dc->call();

echo "<div> par.phar 包调用 本项目没有的包 Requests </div>";

$dc->callR();
