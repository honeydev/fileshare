<?php
require_once './vendor/autoload.php';

use \Ds\Queue;

$app = new \Slim\App(['settings' => (require('./config/cfg.php'))]);
$container = $app->getContainer();
$container->register(new \Fileshare\Db\EloquentServiceProvider());

$tasksMap = $container->get('settings')['tasks'];
$args = $_SERVER['argv'];

if ($args[1] !== '-t' || count($args) < 3) {
    echo "Invalid schema format, requirement: \"-t taskName1 taskName2 taskName3\"\n";
}

$tasks = array_slice($args, 2);

foreach ($tasks as $taskName) {
    if (array_key_exists($taskName, $tasksMap)) {
        $task = new $tasksMap[$taskName]($container);
        $task->do();
    } else {
        throw new InvalidArgumentException("Unknow task name {$taskName}");
    }
}
