<?php

require_once './vendor/autoload.php';

$app = new \Slim\App(['settings' => (require('./config/cfg.php'))]);
$container = $app->getContainer();
$container->register(new \Fileshare\Db\EloquentServiceProvider());
$dbSettings = $container['settings']['db'];
$pdo = new PDO(
    "mysql:dbname={$dbSettings['database']};host={$dbSettings['host']}",
    $dbSettings['username'],
    $dbSettings['password']
);
$testsPdo = new PDO(
    "mysql:dbname=fileshare_tests;host=172.17.0.2",
    $dbSettings['username'],
    $dbSettings['password']
);
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($dbSettings);
$capsule->setAsGlobal();
$capsule->bootEloquent();

return [
    'paths'                => [
        'migrations' => __DIR__ . '/app/Db/migrations',
        'seeds'      => 'app/Db/seeds',
    ],
    'environments' =>
        [
            'default_database' => 'development',
            'development' => [
                'connection' => $pdo,
                'name' => $dbSettings['database']
            ],
            'production' => [
                'connection' => $pdo,
                'name' => $dbSettings['database']
            ],
            'tests' => [
                'connection' => $testsPdo,
                'name' => $dbSettings['tests_database']
            ],
        ]
];
