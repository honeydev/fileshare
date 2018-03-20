<?php

require '../../vendor/autoload.php';


$app = new \Slim\App(['settings' => (require('../../config/cfg.php'))]);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$users = new \Fileshare\Models\RegularUserModel();
// $users->email = 'test@test.com';
// $users->hash = 'asddadas21a';
// $users->save();

$data = $users::all('email', 'hash');

foreach ($data as $case) {
    echo $case->email;
    echo $case->hash;
}
