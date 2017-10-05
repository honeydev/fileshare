<?php
/** add validators */

$container['SessionModelValidator'] = function () {
	return new Fileshare\Validators\SessionModelValidator();
};

$container['LoginValidator'] = function () {
    return new Fileshare\Validators\LoginValidator();
};

$container['PasswordValidator'] = function () {
    return Fileshare\Validators\PasswordValidator();
};