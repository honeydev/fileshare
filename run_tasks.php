#!/usr/bin/php 
<?php


require_once __DIR__ . '/vendor/autoload.php';

$app = new \Slim\App(['settings' => (require(__DIR__ . '/config/cfg.php'))]);
$container = $app->getContainer();
$container->register(new \Fileshare\Db\EloquentServiceProvider());

define('ROOT', __DIR__);

require ROOT . '/app/bootstrap/components.php';
require ROOT . '/app/bootstrap/errorhandlers.php';
require ROOT . '/app/bootstrap/helpers.php';
require ROOT . '/app/bootstrap/controllers.php';
require ROOT . '/app/bootstrap/models.php';
require ROOT . '/app/bootstrap/services.php';
require ROOT . '/app/bootstrap/tasks.php';
require ROOT . '/app/bootstrap/paginators.php';
require ROOT . '/app/bootstrap/searchers.php';
require ROOT . '/app/bootstrap/auths.php';
require ROOT . '/app/bootstrap/validators.php';
require ROOT . '/app/bootstrap/handlers.php';
require ROOT . '/app/Routes.php';

$tasksMap = $container->get('settings')['tasks'];
$args = $_SERVER['argv'];

if ($args[1] !== '-t' || count($args) < 3) {
    throw new InvalidArgumentException("\e[31mInvalid schema format, requirement: \"-t taskName1 taskName2 taskName3\e[0m\"\n");
}

$tasks = array_slice($args, 2);

foreach ($tasks as $taskName) {
    if (array_key_exists($taskName, $tasksMap)) {
        $task = new $tasksMap[$taskName]($container);
        $task->do();
        echo "\e[32mTask {$taskName} executed successful!\e[0m\n";
    } else {
        throw new InvalidArgumentException("\e[31mUnknow task name {$taskName}\e[0m");
    }
}
