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