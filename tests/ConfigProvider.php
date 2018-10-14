<?php

declare(strict_types=1);

namespace FileshareTests;

use \Codeception\Util\Debug as debug;

class ConfigProvider
{
    public static function provide($settings): array
    {
        $newSettings = require ROOT . '/config/cfg.php';
        $newSettings['db']['database'] = $newSettings['db']['tests_database'];
        return $newSettings;
    }
}
