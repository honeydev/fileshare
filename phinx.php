<?php

require_once './vendor/autoload.php';

$app = new \Slim\App(['settings' => (require('./config/cfg.php'))]);
$container = $app->getContainer();
$container->register(new \Fileshare\Db\EloquentServiceProvider());
$config = $container['settings']['db'];

return [
    'paths'                => [
        'migrations' => __DIR__ . '/app/Db/migrations',
        'seeds'      => 'app/Db/seeds',
    ],
    'migration_base_class' => 'BaseMigration',
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database'        => 'development',
        'development'             => [
            'adapter'   => $config['driver'],
            'host'      => $config['host'],
            'name'      => $config['database'],
            'user'      => $config['username'],
            'pass'      => $config['password'],
            'port'      => $config['port'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        'production'              => [
            'adapter'   => $config['driver'],
            'host'      => $config['host'],
            'name'      => $config['database'],
            'user'      => $config['username'],
            'pass'      => $config['password'],
            'port'      => $config['port'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        'tests' => [
                        'adapter'   => $config['driver'],
            'host'      => $config['host'],
            'name'      => $config['database'] . "_test",
            'user'      => $config['username'],
            'pass'      => $config['password'],
            'port'      => $config['port'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];
