<?php

$container['BrowsePaginator'] = function () use ($container) {
    return new Fileshare\Paginators\BrowsePaginator($container);
};
