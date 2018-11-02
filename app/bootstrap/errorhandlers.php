<?php

$container['errorHandler'] = function () use ($container) {
    if ($container->get('request')->isXhr()) {
        return new Fileshare\Handlers\JsonErrorHandler($container);
    } else {
        return new Fileshare\Handlers\CommonErrorHandler($container);
    }
};

$container['phpErrorHandler'] = function () use ($container) {
    return new Fileshare\Handlers\PhpErrorHandler($container);
};
