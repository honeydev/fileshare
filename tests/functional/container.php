<?php

require dirname(dirname(__DIR__)).'/vendor/autoload.php';

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;

define('ROOT', dirname(dirname(__DIR__)));

$container = new Container([
    App::class => function (ContainerInterface $c) {
        $app = new App($c);
        $settings = $c->get('settings');
        $settings->replace(['debug' => true, 'displayErrorDetails' => true]);
        // routes and middlewares here
        $app->post('/profile.form', 'ProfileController:changeProfile');
        return $app;
    }
]);

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

require ROOT . '/app/bootstrap/errorhandlers.php';
require ROOT . '/app/bootstrap/controllers.php';
require ROOT . '/app/bootstrap/models.php';
require ROOT . '/app/bootstrap/services.php';
require ROOT . '/app/bootstrap/helpers.php';
require ROOT . '/app/bootstrap/auths.php';
require ROOT . '/app/bootstrap/validators.php';

return $container;