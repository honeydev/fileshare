<?php

/* add services */
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

$container['UploadsMovementService'] = function () use ($container) {
    return new Fileshare\Services\UploadsMovementService($container);
};

$container['FileSaveService'] = function () use ($container) {
    return new Fileshare\Services\FileSaveService($container);
};

$container['DeleteFileService'] = function () use ($container) {
    return new Fileshare\Services\DeleteFileService($container);
};

$container['FileAvatarService'] = function () use ($container) {
    return new Fileshare\Services\FileAvatarService($container);
};

$container['SelectFilesService'] = function () use ($container) {
    return new Fileshare\Services\SelectFilesService($container);
};

$container['AllowCursorValueCalculateService'] = function () use ($container) {
    return new Fileshare\Services\AllowCursorValueCalculateService($container);
};

$container['SelectFilesCountService'] = function () use ($container) {
    return new Fileshare\Services\SelectFilesCountService($container);
};

$container['SliceFilesQueryService'] = function () use ($container) {
    return new Fileshare\Services\SliceFilesQueryService($container);
};
