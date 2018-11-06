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
    /* server side token */
    'secretKey' => '',
    'appFolder' => dirname(__DIR__),
    /*
     * Max allow uploaded file size in bytes
     */
    'maxFileSize' => 104857600,
    /*
     * file live cycle in hours
     */
    'storageTime' => 120,
    /* Count files on search page, browse page */
    'filesOnPage' => 5,
    'previewsMap' => [
        /* default files previews */
        'default' => [
            'unknown' => '/img/file.svg',
        ],
        /* support file preview */
        'supported' => ['image/jpeg', 'image/png'],
    ],
    /* 
     * favicon path
     */
    'favicon' => '/img/favicon.ico',
    /*
     * tasks class running from cli
     */
    'tasks' => [
        'cleanFiles' => \Fileshare\Tasks\CleanOldFilesTask::class
    ]
);
