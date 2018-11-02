<?php
/* add auths */
$container['LoginAuth'] = function ($container) {
    return new Fileshare\Auth\LoginAuth($container);
};

$container['RegisterAuth'] = function ($container) {
    return new Fileshare\Auth\RegisterAuth($container);
};

$container['ProfileAuth'] = function ($container) {
    return new Fileshare\Auth\ProfileAuth($container);
};
