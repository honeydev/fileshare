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
        $app->group('', function () use ($app, $container) {
            $app->get('/', 'MainPageController:indexPage');
            $app->post('/upload.file', 'MainPageController:uploadFile');
            $app->post('/login.form', 'LoginController:login')
                ->add(new \Fileshare\Middlewares\LoginMiddleware($container))
                ;
            $app->post('/register.form', 'RegisteredController:registered')
                ->add(new \Fileshare\Middlewares\RegDbMiddleware($container))
                ->add(new \Fileshare\Middlewares\RegUserTypeMiddleware($container))
                ->add(new \Fileshare\Middlewares\RegValidateMiddleware($container))
            ;
            $app->post('/profile.form', 'ProfileController:changeProfile');
            $app->post('/userAvatar.file', function ($request, $response) {
                var_dump($request->getUploadedFiles());
            });
            $app->get('/logout.action', 'LogoutController:logout');
            $app->get('/tests/{testName}', 'TestsController:testsPage');
        })->add(new \Fileshare\Middlewares\SessionMiddleware($container));
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