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

