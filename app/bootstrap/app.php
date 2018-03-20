<?php
/**
 * add app main object
 */
namespace Fileshare;

$app = new \Slim\App(['settings' => (require(ROOT . '/config/cfg.php'))]);
$container = $app->getContainer();
