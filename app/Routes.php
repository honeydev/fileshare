<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Controllers\MainPageController as MainPageController;

class Routes
{
    private $loginMiddleware;

    public function __construct($app, $container)
    {
        $this->startRoutes($app, $container);
        $this->loginMiddleware = $container->get('LoginMiddleware');
    }

    private function startRoutes($app, $container)
    {
        $app->get('/', 'MainPageController:indexPage');
        $app->get('/login.form')->($this->loginMiddleware);
    }
}
