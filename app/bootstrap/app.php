<?php
/**
 * add app main object
 */
namespace Fileshare;

$app = new \Slim\App(['settings' => (require('../config/cfg.php'))]);
