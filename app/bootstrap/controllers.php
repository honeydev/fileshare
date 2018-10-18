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

$container['LogoutController'] = function () use ($container) {
    return new Fileshare\Controllers\LogoutController($container);
};

$container['RegisteredController'] = function () use ($container) {
    return new Fileshare\Controllers\RegisteredController($container);
};

$container['TestsController'] = function () use ($container) {
    return new Fileshare\Controllers\TestsController($container);
};

$container['ProfileController'] = function () use ($container) {
    return new Fileshare\Controllers\ProfileController($container);
};

$container['ServiceController'] = function () use ($container) {
    return new Fileshare\Controllers\ServiceController($container);
};

$container['FilePageController'] = function () use ($container) {
    return new Fileshare\Controllers\FilePageController($container);
};

$container['BrowseFileController'] = function () use ($container) {
    return new Fileshare\Controllers\BrowseFileController($container);
};

$container['SearchPageController'] = function () use ($container) {
    return new Fileshare\Controllers\SearchPageController($container);
};
