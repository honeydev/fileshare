<?php

$container['User'] = function ($c) {
    return new \Fileshare\Db\models\User($c);
};