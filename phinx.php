<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => 'mysql',
            'host' => $_SERVER['DB_HOST'],
            'name' => $_SERVER['DB_DATABASE'],
            'user' => $_SERVER['DB_USERNAME'],
            'pass' => $_SERVER['DB_PASSWORD'],
            'port' => $_SERVER['DB_PORT'],
            'charset' => $_SERVER['DB_CHARSET']
        ]
    ],
    'version_order' => 'creation'
];
