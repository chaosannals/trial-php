<?php return [
    'default' => [
        'host' => env('db_host', 'exert-hyperf-nano-mysql'),
        'port' => env('db_port', 3306),
        'database' => env('db_name', 'exert'),
        'username' => env('db_user', 'root'),
        'password' => env('db_pass', 'root'),
        'collation' => 'utf8mb4_unicode_ci',
    ],
];