<?php

$container['User'] = function ($container) {
    return new \Fileshare\Db\models\User($container);
};
