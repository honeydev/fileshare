<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class ConfigHelper
{
    public static function getAppHost()
    {
        if (!array_key_exists('HTTP_HOST', $_SERVER)) {
            return false;
        }

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];
        return $protocol . $domainName;
    }
}