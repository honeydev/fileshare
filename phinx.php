<?php

require_once './vendor/autoload.php';

$app = new \Slim\App(['settings' => (require('./config/cfg.php'))]);
$container = $app->getContainer();
$container->register(new \Fileshare\Db\EloquentServiceProvider());

\Fileshare\Facades\AppFacade::add($app);


if (in_array('-e', $_SERVER['argv']) && in_array('tests', $_SERVER['argv'])) {
    $dbSettings = $container['settings']['db'];
    $dbSettings['database'] = $dbSettings['tests_database'];
    $pdo = new PDO(
        "mysql:dbname={$dbSettings['tests_database']};host={$dbSettings['host']}",
        $dbSettings['username'],
        $dbSettings['password']
    );
} else {
    $dbSettings = $container['settings']['db'];
    $pdo = new PDO(
        "mysql:dbname={$dbSettings['database']};host={$dbSettings['host']}",
        $dbSettings['username'],
        $dbSettings['password']
    );
}

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
                'connection' => $pdo,
                'name' => $dbSettings['tests_database']
            ],
        ]
];
