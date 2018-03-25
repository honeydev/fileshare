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
$user = $users::where("email", '12345')->first();
var_dump($user);
echo $user->email;
// $user = \Fileshare\Db\ORM\Users::create(['email' => 'devspades@gmail.com', 'hash' => 'asdasd123wasda']);
// echo $user->id;
// $user = $users::find(1);
// var_dump($user->id);
// $users->email = 'test@test.com';
// $users->hash = 'asddadas21a';
// $users->save();

// $data = $users::all('email', 'hash');

// foreach ($data as $case) {
//     echo $case->email;
//     echo $case->hash;
// }
