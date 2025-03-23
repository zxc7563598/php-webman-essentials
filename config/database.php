<?php
return  [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'driver'      => 'mysql',
            'host'        => getenv('DB_HOST'),
            'port'        => getenv('DB_PORT'),
            'database'    => getenv('DB_DATABASE'),
            'username'    => getenv('DB_USERNAME'),
            'password'    => getenv('DB_PASSWORD'),
            'charset'     => getenv('DB_CHARSET'),
            'collation'   => getenv('DB_COLLATION'),
            'prefix'      => '',
            'strict'      => true,
            'engine'      => null,
            'options'   => [
                PDO::ATTR_EMULATE_PREPARES => false, // Must be false for Swoole and Swow drivers.
            ],
            'pool' => [
                'max_connections' => 5,
                'min_connections' => 1,
                'wait_timeout' => 3,
                'idle_timeout' => 60,
                'heartbeat_interval' => 50,
            ],
        ],
    ],
];