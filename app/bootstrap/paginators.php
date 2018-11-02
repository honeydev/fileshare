<?php

/* add pagination */
$container['BrowsePaginator'] = function () use ($container) {
    return new Fileshare\Paginators\BrowsePaginator($container);
};

$container['SearchPaginator'] = function () use ($container) {
    return new Fileshare\Paginators\SearchPaginator($container);
};
