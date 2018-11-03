<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

define('ROOT', dirname(__DIR__));

require ROOT . '/vendor/autoload.php';
require ROOT . '/app/bootstrap/app.php';
require ROOT . '/app/bootstrap/components.php';
require ROOT . '/app/bootstrap/errorhandlers.php';
require ROOT . '/app/bootstrap/helpers.php';
require ROOT . '/app/bootstrap/controllers.php';
require ROOT . '/app/bootstrap/models.php';
require ROOT . '/app/bootstrap/services.php';
require ROOT . '/app/bootstrap/tasks.php';
require ROOT . '/app/bootstrap/paginators.php';
require ROOT . '/app/bootstrap/searchers.php';
require ROOT . '/app/bootstrap/auths.php';
require ROOT . '/app/bootstrap/validators.php';
require ROOT . '/app/bootstrap/handlers.php';
require ROOT . '/app/Routes.php';

$routes = new Routes();
$routes->start($app, $container);

$app->run();
