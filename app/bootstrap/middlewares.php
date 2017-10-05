<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/6/17
 * Time: 12:01 AM
 */

$container['LoginMiddleware'] = function ($container) {
    return new Fileshare\Middlewares\LoginMiddleware($container);
};