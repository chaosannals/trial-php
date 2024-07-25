<?php return [
    'default' => [
        'host' => env('db_host', 'exert-hyperf-nano-mysql'),
        'port' => env('db_port', 3306),
        'database' => env('db_name', 'exert'),
        'username' => env('db_user', 'root'),
        'password' => env('db_pass', 'root'),
        'collation' => 'utf8mb4_unicode_ci',
    ],
    'local' => [
        'host' => '172.31.16.1', // 通过 ipconfig 找到 wsl 的网卡 IP 就可以连接宿主机。
        'port' => 3306,
        'database' => 'exert',
        'username' => 'root',
        'password' => 'root',
        'collation' => 'utf8mb4_unicode_ci',
    ],
];