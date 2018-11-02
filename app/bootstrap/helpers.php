<?php

/* add helpers */
$container['PrepareErrorHelper'] = function () use ($container) {
    return new Fileshare\Helpers\PrepareErrorHelper($container);
};

$container['CRUDsHelper'] = function () use ($container) {
    return new Fileshare\Helpers\CRUDsHelper();
};
