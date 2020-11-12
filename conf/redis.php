<?php return [
    'default' => [
        'host' => env('redis_host', 'exert-hyperf-nano-redis'),
        'auth' => env('redis_auth', ''),
        'port' => (int) env('redis_port', 6379),
        'db' => (int) env('redis_db', 0),
        'cluster' => [
            'enable' => (bool) env('redis_cluster_enable', false),
            'name' => null,
            'seeds' => [],
        ],
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 10,
            'connect_timeout' => 10.0,
            'wait_timeout' => 3.0,
            'heartbeat' => -1,
            'max_idle_time' => (float) env('redis_max_idle_time', 60),
        ],
    ],
];
