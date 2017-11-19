<?php

$container['PrepareErrorHelper'] = function () use ($container) {
    return new Fileshare\Helpers\PrepareErrorHelper($container);
};
