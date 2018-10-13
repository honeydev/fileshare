<?php

require '../../vendor/autoload.php';


$app = new \Slim\App(['settings' => (require('../../config/cfg.php'))]);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$users = new \Fileshare\Db\ORM\Users();
$usersInfo = new \Fileshare\Db\ORM\UsersInfo();
$usersSettings = new \Fileshare\Db\ORM\UsersSettings();
$select = $users::select("users.email", "users_info.name", "users_settings.access_lvl", "users_settings.account_status")->leftJoin('users_info', 'users.id', '=', 'users_info.user_id')->leftJoin('users_settings', 'users.id', '=', 'users_info.user_id')->where('users.id', '=', '4');

var_dump($select->get()->toArray());