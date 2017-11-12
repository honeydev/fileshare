<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/11/17
 * Time: 9:21 PM
 */

$container['SessionService'] = function () use ($container) {
    return new Fileshare\Services\SessionService($container);
};

$container['SessionDestroyer'] = function() use ($container) {
    return new \Fileshare\Services\SessionDestroyService($container);
};

$container['CookieService'] = function () {
    return new Fileshare\Services\CookieService();
};

$container['UserService'] = function () {
    return new Fileshare\Services\UserService();
};

$container['AddUserService'] = function () use ($container) {
    return new Fileshare\Services\AddUserService($container);
};

$container['CryptoService'] = function () use ($container) {
    return new Fileshare\Services\CryptoService($container);
};