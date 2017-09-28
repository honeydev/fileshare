<?php

namespace Fileshare;

/**
 * Add components in project:
 * - monolog
 * - pdo
 * - slim views
 * - twig
 */

$container = $app->getContainer();
$appFolder = dirname(dirname(__FILE__));

$container['logger'] = function () {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('../logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['db'] = function ($container) {
    $db = $container['settings']['db'];
    $pdo = new \PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'], $db['user'], $db['pass']);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    return $pdo;
};

$container['view'] = function ($container) use ($appFolder) {
    $view = new \Slim\Views\Twig($appFolder . "/Views", [
        'cache' => false,
        'debug' => true
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};