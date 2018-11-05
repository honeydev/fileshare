<?php

$container['AvatarSaver'] = function () use ($container) {
    return new Fileshare\Savers\AvatarSaver($container);
};

$container['FileSaver'] = function () use ($container) {
    return new Fileshare\Savers\FileSaver($container);
};
