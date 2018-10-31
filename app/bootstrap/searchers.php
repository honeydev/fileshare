<?php

$container['FileSearcher'] = function () use ($container) {
    return new Fileshare\Searchers\FileSearcher($container);
};
