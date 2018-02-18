<?php

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;

define('ROOT', dirname(dirname(__DIR__)));

$container = new Container([
    App::class => function (ContainerInterface $container) {
        $app = new App($container);
        $settings = $container->get('settings');
        $settings->replace(require ROOT . '/config/cfg.php');
        // routes and middlewares here
        $routes = new \Fileshare\Routes();
        $routes->startRoutes($app, $container);
        return $app;
    }
]);

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

$container['db'] = function ($container) {
    $db = $container['settings']['db'];
    $pdo = new \PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'], $db['user'], $db['pass']);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    return $pdo;
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

require ROOT . '/app/bootstrap/dbmodels.php';
require ROOT . '/app/bootstrap/errorhandlers.php';
require ROOT . '/app/bootstrap/controllers.php';
require ROOT . '/app/bootstrap/models.php';
require ROOT . '/app/bootstrap/services.php';
require ROOT . '/app/bootstrap/helpers.php';
require ROOT . '/app/bootstrap/auths.php';
require ROOT . '/app/bootstrap/validators.php';

return $container;