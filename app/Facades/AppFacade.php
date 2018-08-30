<?php

declare(strict_types=1);

namespace Fileshare\Facades;

use \Slim\App;

class AppFacade
{
    private static $app;

    public static function add(App $app)
    {
        self::$app = $app;
    }

    public static function get(): App
    {
        return self::$app;
    }
}
