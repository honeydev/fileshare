<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/6/17
 * Time: 12:04 AM
 */

$container['LoginAuth'] = function ($container) {
    return new Fileshare\Auth\LoginAuth($container);
};