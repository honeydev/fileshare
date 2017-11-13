<?php

require dirname(dirname(__DIR__)) . "/vendor/autoload.php";

$settings = require dirname(dirname(__DIR__)) . "/config/cfg.php";
$db = $settings['db'];

$pdo = new \PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'], $db['user'], $db['pass']);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
$GLOBALS['pdo'] = $pdo;