<?php

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;
use FileshareTests\ConfigProvider;
use \Codeception\Util\Debug as debug;

define('ROOT', dirname(dirname(__DIR__)));
ini_set('date.timezone', "Asia/Vladivostok");

$container = new Container([
    App::class => function (ContainerInterface $container) {
        $app = new App($container);
        \Fileshare\Facades\AppFacade::add($app);
        $settings = $container->get('settings');
        $newSettings = ConfigProvider::provide($settings);
        $settings->replace($newSettings);
        $container->register(new \Fileshare\Db\EloquentServiceProvider());
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


require ROOT . '/app/bootstrap/errorhandlers.php';
require ROOT . '/app/bootstrap/controllers.php';
require ROOT . '/app/bootstrap/models.php';
require ROOT . '/app/bootstrap/services.php';
require ROOT . '/app/bootstrap/paginators.php';
require ROOT . '/app/bootstrap/tasks.php';
require ROOT . '/app/bootstrap/searchers.php';
require ROOT . '/app/bootstrap/helpers.php';
require ROOT . '/app/bootstrap/auths.php';
require ROOT . '/app/bootstrap/validators.php';

\Codeception\Util\Fixtures::add('container', $container);

return $container;