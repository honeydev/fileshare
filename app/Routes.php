<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Controllers\MainPageController as MainPageController;
use Fileshare\Middlewares\LoginMiddleware as LoginMiddleware;
use Fileshare\Middlewares\RegValidateMiddleware as RegValidateMiddleware;
use Fileshare\Middlewares\RegDbMiddleware as RegDbMiddleware;
use Fileshare\Middlewares\RegUserTypeMiddleware as RegUserTypeMiddleware;

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
        $app->post('/login.form', 'MainPageController:loginUser')->add(new LoginMiddleware($this->container));
        $app->post('/register.form', 'MainPageController:regUser')
            ->add(new RegDbMiddleware($this->container))
            ->add(new RegUserTypeMiddleware($this->container))
            ->add(new RegValidateMiddleware($this->container))
        ;
        $app->post('/upload.file', 'MainPageController:uploadFile');
    }
}
