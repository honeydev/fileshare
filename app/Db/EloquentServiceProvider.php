<?php
/**
 * @class EloquentServiceProvider
 */

declare(strict_types=1);

namespace Fileshare\Db;

use Illuminate\Database\Capsule\Manager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class EloquentServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $capsule = new Manager();
        $capsule->addConnection($container['settings']['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $container['db'] = function ($c) use ($capsule) {
            return $capsule;
        };
    }
}