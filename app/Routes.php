<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Controllers\MainPageController as MainPageController;
use Fileshare\Middlewares\LoginMiddleware as LoginMiddleware;
use Fileshare\Middlewares\RegValidateMiddleware as RegValidateMiddleware;
use Fileshare\Middlewares\RegDbMiddleware as RegDbMiddleware;

class Routes
{
    private $loginMiddleware;

    public function __construct($app, $container)
    {
        $this->container = $container;
        $this->startRoutes($app, $container);
    }

    private function startRoutes($app, $container)
    {
        $app->get('/', 'MainPageController:indexPage');
        $app->post('/login.form', function () {
            echo 'login.form';
        })->add(new LoginMiddleware($this->container));
        $app->post('/register.form', function () {
            echo 'register.form';
        })
            ->add(new RegValidateMiddleware($this->container))
            ->add(new RegDbMiddleware($this->container))
            ;
    }
}
