<?php

use Fileshare\Helpers\ConfigHelper;

return array(
    'development' => true,
    'displayErrorDetails' => true,
    'logging' => true,
    'addContentLengthHeader' => false,
    'db' => array(
        'driver' => 'mysql',
        'host' => '172.18.0.2',
        'database' => 'fileshare',
        'tests_database' => 'fileshare_tests',
        'username' => 'root',
        'password' => 'd5d7',
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
    'secretKey' => 'MWeXB081vCSdOdwxr5w_z2NV09fTxNFBKw0GXOuqrz_Q-tlY8pspmragIuMClhH_qPebfMsBPpUbSkRxfELAqncsmM4U4FpaiE4EA3AM2PKFl7alMDJroZ3SmbwiaQ0Qg4HcAkua1d8Sgbv7xDzUOqY1xEyfY4oMaPZwb6BjofQRljFPexlBgUZ9TgSsAMqW86p7OLKWfgqJ_uak46uE-qP3DHpVIT_6-8u1FFsiykANjoUKY-4YcCtbxoCxOSrJniN3UFNhLEfcwL6D2kQORlHsFCXx7ndBSr1G93sAZ39uwGzLnDsWJnQNjVR5pYJv0wJ-HIrvBFty0H9BQ_KLgQ',
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
        'supported' => ['image/jpeg'],
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
