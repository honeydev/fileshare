<?php

/* add models */
$container['User'] = function () {
    return new Fileshare\Models\User();
};

$container['UsersInfo'] = function () {
    return new Fileshare\Models\UsersInfo;
};

$container['UsersSettings'] = function () {
    return new Fileshare\Models\UsersSettings();
};
