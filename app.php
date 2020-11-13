<?php

use Hyperf\HttpMessage\Stream\SwooleStream;
use exert\Application;
use exert\Log;
use exert\Redis;
use exert\Db;

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application(__DIR__);
$app->apply();

$app->get('/', function () {
    $user = $this->request->input('user', 'nano');
    $method = $this->request->getMethod();
    Log::get()->info('aaaaa');
    $rks = Redis::get()->keys('*');
    Db::get('default')->execute("CREATE TABLE IF NOT EXISTS `e_tester` (
        `id` int NOT NULL AUTO_INCREMENT,
        `jobnumber` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
        `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
        `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `update_at` datetime DEFAULT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `tester_jobnumber` (`jobnumber`),
        KEY `tester_create_at` (`create_at`),
        KEY `tester_update_at` (`update_at`)
      ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    Db::get('default')->execute("INSERT INTO e_tester (`jobnumber`, `name`)
        SELECT LPAD(COUNT(*) + 1, 6 , '0'),
            CONCAT('Tester-', LPAD(COUNT(*) + 1, 6 , '0'))
        FROM e_tester;");
    $testers = Db::get('default')->query("SELECT * FROM e_tester");
    return [
        'message' => "hello {$user}",
        'method' => $method,
        'env' => env('db_host'),
        'conf' => config('redis'),
        'rks' => $rks,
        'testers' => $testers,
    ];
});

$app->addExceptionHandler(function ($throwable, $response) {
    return $response->withStatus('418')
        ->withBody(new SwooleStream($throwable->getMessage()));
});


$app->run();
