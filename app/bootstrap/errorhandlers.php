<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/14/17
 * Time: 11:01 PM
 */

$container['errorHandler'] = function () use ($container) {
    return new Fileshare\Handlers\ErrorHandler($container);
};

$container['phpErrorHandler'] = function () use ($container) {
    return new Fileshare\Handlers\PhpErrorHandler($container);
};
