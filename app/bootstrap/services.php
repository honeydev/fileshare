<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/11/17
 * Time: 9:21 PM
 */

$container['SessionService'] = function ($container) {
    return new Fileshare\Services\SessionService($container);
};

$container['SessionDestroyer'] = function ($container) {
    return new \Fileshare\Services\SessionDestroyService($container);
};

$container['CookieService'] = function () {
    return new Fileshare\Services\CookieService();
};

$container['errorHandler'] = function ($container) {
    return function ($request, $response, $exception) use ($container) {
        return $container['response']->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('Something went wrong!');
    };
};

