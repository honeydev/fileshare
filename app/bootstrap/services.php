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

$container['SessionDestroyer'] = function () use ($container) {
    return new \Fileshare\Services\SessionDestroyService($container);
};

$container['CookieService'] = function () {
    return new Fileshare\Services\CookieService();
};

$container['CreateUserService'] = function () use ($container) {
    return new Fileshare\Services\CreateUserService($container);
};

$container['AddUserService'] = function () use ($container) {
    return new Fileshare\Services\AddUserService($container);
};

$container['CryptoService'] = function () use ($container) {
    return new Fileshare\Services\CryptoService($container);
};

$container['UpdateUserService'] = function () use ($container) {
    return new Fileshare\Services\UpdateUserService($container);
};

$container['UploadsMovmentService'] = function () use ($container) {
    return new Fileshare\Services\UploadsMovmentService($container);
};

$container['FileSaveService'] = function () use ($container) {
    return new Fileshare\Services\FileSaveService($container);
};

$container['DeleteFileService'] = function () use ($container) {
    return new Fileshare\Services\DeleteFileService($container);
};

$container['AddAvatarService'] = function () use ($container) {
    return new Fileshare\Services\AddAvatarService($container);
};

$container['FileAvatarService'] = function () use ($container) {
    return new Fileshare\Services\FileAvatarService($container);
};
