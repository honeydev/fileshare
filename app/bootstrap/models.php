<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/11/17
 * Time: 9:21 PM
 */

$container['SessionModel'] = function ($container) {
    return Fileshare\Models\SessionModel::createSessionModel($container);
};

$container['RegularUserModel'] = function ($container) {
    return new Fileshare\Models\RegularUserModel($container);
};

$container['GuestUserModel'] = function ($container) {
    return new Fileshare\Models\GuestUserModel($container);
};

$container['AdminUserModel'] = function ($container) {
    return new Fileshare\Models\AdminUserMode($container);
};
