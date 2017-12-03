<?php
/**
 * Add all app controllers
 */

$container['MainPageController'] = function () use ($container) {
    return new Fileshare\Controllers\MainPageController($container);
};

$container['LoginController'] = function () use ($container) {
	return new Fileshare\Controllers\LoginController($container);
};

$container['RegisteredController'] = function () use ($container) {
	return new Fileshare\Controllers\RegisteredController($container);
};
