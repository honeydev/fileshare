<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

define('ROOT', dirname(dirname(__DIR__)));
ini_set('session.use_strict_mode', 1);
ini_set('session.use_only_cookies = 1', 1);
ini_set('display_errors',1);
register_shutdown_function(function() {
    $e = error_get_last();
    if (!empty($e)) {
        var_dump($e);
    }
});

require ROOT . '/vendor/autoload.php';
require ROOT . '/app/bootstrap/app.php';
require ROOT . '/app/bootstrap/dbmodels.php';
require ROOT . '/app/bootstrap/components.php';
require ROOT . '/app/bootstrap/controllers.php';
require ROOT . '/app/bootstrap/models.php';
require ROOT . '/app/bootstrap/services.php';
require ROOT . '/app/bootstrap/helpers.php';
require ROOT . '/app/bootstrap/auths.php';
require ROOT . '/app/bootstrap/validators.php';
require ROOT . '/app/bootstrap/errorhandlers.php';

//по непонятной мне причине в файле /app/bootstrap/dbmodels.php
// не добавляется в коннейнер модель базы User совсем никак
$container['User'] = function ($container) {
    return new \Fileshare\Db\models\User($container);
};

Fixtures::add('app', $app);
Fixtures::add('container', $container);
