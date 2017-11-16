<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/14/17
 * Time: 11:01 PM
 */

$container['errorHandler'] = function () use ($container) {
    if ($container->get('request')->isXhr()) {
        return new Fileshare\Handlers\JsonErrorHandler($container);
    } else {
        return new Fileshare\Handlers\CommonErrorHandler($container);
    }
};

$container['phpErrorHandler'] = function () use ($container) {
    if ($container->get('request')->isXhr()) {
        return new Fileshare\Handlers\PhpErrorHandler($container);
    } else {
        return new Fileshare\Handlers\JsonPhpErrorHandler($container);
    }
};
