<?php

/*
 * Add components in project:
 * - monolog
 * - pdo
 * - slim views
 * - twig
 */

$container = $app->getContainer();
$container->register(new \Fileshare\Db\EloquentServiceProvider());

$container['db'] = function ($container) {
    $db = $container['settings']['db'];
    $pdo = new \PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['database'], $db['username'], $db['password']);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    return $pdo;
};

$container['ErrorLogger'] = function () {
    $logger = new \Monolog\Logger('errorLogger');
    $file_handler = new \Monolog\Handler\StreamHandler(ROOT . '/logs/errors.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['WarningLogger'] = function () {
    $logger = new \Monolog\Logger('warningLogger');
    $file_handler = new \Monolog\Handler\StreamHandler(ROOT . '/logs/warnings.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['NoticeLogger'] = function () {
    $logger = new \Monolog\Logger('noticeLogger');
    $file_handler = new \Monolog\Handler\StreamHandler(ROOT . '/logs/notices.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['AuthorizeLogger'] = function () {
    $logger = new \Monolog\Logger('authorizeLogger');
    $file_handler = new \Monolog\Handler\StreamHandler(ROOT . '/logs/authorizes.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['AccessLogger'] = function () {
    $logger = new \Monolog\Logger('accessLogger');
    $file_handler = new \Monolog\Handler\StreamHandler(ROOT . '/logs/access.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['Logger'] = function ($container) {
    return new \Fileshare\Components\Logger($container);
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(ROOT . "/app/Views", [
        'cache' => false,
        'debug' => true
    ]);
    // add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));
    return $view;
};

$container['ACL'] = function () {
    return new \Fileshare\ACL();
};

