<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Routes
{
    public function startRoutes($app, $container)
    {
        $app->group('', function () use ($app, $container) {
            $app->get('/', 'MainPageController:indexPage');
            $app->post('/upload.file', 'MainPageController:uploadFile');
            $app->post('/login.form', 'LoginController:login')
                ->add(new \Fileshare\Middlewares\LoginAuthMiddleware($container))
                ->add(new \Fileshare\Middlewares\LoginValidateMiddleware($container));
            $app->post('/register.form', 'RegisteredController:registered')
                ->add(new \Fileshare\Middlewares\RegUserTypeMiddleware($container))
                ->add(new \Fileshare\Middlewares\RegValidateMiddleware($container));
            $app->post('/profile.form', 'ProfileController:changeProfile')
                ->add(new \Fileshare\Middlewares\ProfileValidateMiddleware($container))
                ->add(new \Fileshare\Middlewares\ProfileAccessMiddleware($container))
                ->add(new \Fileshare\Middlewares\AuthMiddleware($container))
                ;
            $app->post('/uploadavatar.file', 'ProfileController:uploadAvatar');
            $app->get('/logout.action', 'LogoutController:logout');
            $app->get('/tests/{testName}', 'TestsController:testsPage');
        });
    }
}
