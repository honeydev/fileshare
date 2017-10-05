<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies = 1', 1);

require '../vendor/autoload.php';
require '../app/bootstrap/app.php';
require '../app/bootstrap/components.php';
require '../app/bootstrap/errorhandlers.php';
require '../app/bootstrap/controllers.php';
require '../app/bootstrap/models.php';
require '../app/bootstrap/services.php';
require '../app/bootstrap/middlewares.php';
require '../app/bootstrap/auths.php';
require '../app/bootstrap/validators.php';
require '../app/Routes.php';


$routes = new Routes($app, $container);

$app->run();
