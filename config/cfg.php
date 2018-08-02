<?php

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
       'title' => 'Fileshare',
       'hostname' => 'fileshare.loc'
    ),
    'secretKey' => '8ryR.h6vc58wEk3GxQpJS.gSaTnuDHFEkITfb4//4OTHUGW5UPkgS',
    'appFolder' => dirname(__DIR__)
);
