<?php

$container['CleanOldFilesTask'] = function () use ($container) {
    return new Fileshare\Tasks\CleanOldFilesTask($container);
};
