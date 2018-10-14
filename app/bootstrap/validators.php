<?php
/** add validators */

$container['SessionModelValidator'] = function () {
	return new Fileshare\Validators\SessionModelValidator();
};

$container['EmailValidator'] = function () {
    return new Fileshare\Validators\EmailValidator();
};

$container['LoginValidator'] = function () {
    return new Fileshare\Validators\LoginValidator();
};

$container['PasswordValidator'] = function () {
    return new Fileshare\Validators\PasswordValidator();
};

$container['NameValidator'] = function () {
    return new Fileshare\Validators\NameValidator();
};

$container['UserTypeValidator'] = function () {
    return new Fileshare\Validators\UserTypeValidator();
};

$container['PasswordEqualValidator'] = function () {
    return new Fileshare\Validators\PasswordsEqualValidator();
};

$container['ImageValidator'] = function () use ($container) {
    return new Fileshare\Validators\ImageValidator($container->get("settings")["maxFileSize"]);
};

$container['BrowseFilesArgumentsValidator'] = function () use ($container) {
    $allowCursorValueCalculateService = $container->get('AllowCursorValueCalculateService');
    $maxAllowCursorValue = $allowCursorValueCalculateService->calculate();
    return new Fileshare\Validators\BrowseFilesArgumentsValidator($maxAllowCursorValue);
};
