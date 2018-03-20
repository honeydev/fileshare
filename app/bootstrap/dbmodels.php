<?php

$container['Users'] = function ($container) {
    return new \Fileshare\Db\models\Users($container);
};