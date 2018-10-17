<?php

use Fileshare\Helpers\ConfigHelper;

return array(
    'development' => true,
    'displayErrorDetails' => true,
    'logging' => true,
    'addContentLengthHeader' => false,
    'db' => array(
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'fileshare',
        'tests_database' => 'fileshare_tests',
        'username' => 'root',
        'password' => '',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'port' => '3306',
    ),
    'appInfo' => array(
       'appName' => 'Fileshare',
       'hostname' => ConfigHelper::getAppHost()
    ),
    'secretKey' => '8ryR.h6vc58wEk3GxQpJS.gSaTnuDHFEkITfb4//4OTHUGW5UPkgS',
    'appFolder' => dirname(__DIR__),
    /*
     * Max allow uploaded file size in bytes
     */
    'maxFileSize' => 104857600,
    'filesOnPage' => 5,
    'previewsMap' => [
        'default' => [
            'unknown' => '/img/file.svg',
        ],
        'supported' => ['image/jpeg'],
    ]
);
