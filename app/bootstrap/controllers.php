<?php
/**
 * Add all app controllers
 */

$container['MainPageController'] = function ($container) {
    return new Fileshare\Controllers\MainPageController($container);
};
