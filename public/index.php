<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

error_reporting(E_ALL); 
ini_set("display_errors", 1); 
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies = 1', 1);

register_shutdown_function(function () {
    $e = error_get_last();
    if (!empty($e)) {
        var_dump($e);
    }
});

define('ROOT', dirname(__DIR__));

require ROOT . '/vendor/autoload.php';
require ROOT . '/app/bootstrap/app.php';
require ROOT . '/app/bootstrap/components.php';
require ROOT . '/app/bootstrap/dbmodels.php';
require ROOT . '/app/bootstrap/errorhandlers.php';
require ROOT . '/app/bootstrap/helpers.php';
require ROOT . '/app/bootstrap/controllers.php';
require ROOT . '/app/bootstrap/models.php';
require ROOT . '/app/bootstrap/services.php';
require ROOT . '/app/bootstrap/auths.php';
require ROOT . '/app/bootstrap/validators.php';
require ROOT . '/app/Routes.php';

$routes = new Routes();
$routes->startRoutes($app, $container);

$app->run();
