<?php

/**
 * Add components in project:
 * - monolog
 * - pdo
 * - slim views
 * - twig
 */

namespace Fileshare;

$container = $app->getContainer();

$container['db'] = function ($container) {
    $eloquentProvider = new \Fileshare\Db\EloquentServiceProvider();
    $capsule = $eloquentProvider->register($container);
    return $capsule;
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

$container['Logger'] = function ($container) {
    return new \Fileshare\Components\Logger($container);
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(dirname(dirname(__FILE__)) . "/Views", [
        'cache' => false,
        'debug' => true
    ]);
    // add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));
    return $view;
};
