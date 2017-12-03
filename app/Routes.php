<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Routes
{
    public function startRoutes($app, $container)
    {

        $app->get('/', 'MainPageController:indexPage');
        $app->post('/upload.file', 'MainPageController:uploadFile');
        $app->post('/login.form', 'LoginController:login')
            ->add(new \Fileshare\Middlewares\LoginMiddleware($container))
            ;
        $app->post('/register.form', 'RegisteredController:registered')
            ->add(new \Fileshare\Middlewares\RegDbMiddleware($container))
            ->add(new \Fileshare\Middlewares\RegUserTypeMiddleware($container))
            ->add(new \Fileshare\Middlewares\RegValidateMiddleware($container))
        ;
    }
}
