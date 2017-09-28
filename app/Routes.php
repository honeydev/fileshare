<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Controllers\MainPageController as MainPageController;

class Routes
{
    public function __construct($app, $container)
    {
        $this->startRouts($app, $container);
    }

    private function startRouts($app, $container)
    {
        $app->get('/', 'MainPageController:indexPage');

    }
}
