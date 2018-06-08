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
                ->add(new \Fileshare\Middlewares\AccessMiddleware($container));
                // ->add(new \Fileshare\Middlewares\RegDbMiddleware($container))
                // ->add(new \Fileshare\Middlewares\ProfileValidateMiddleware($container));
            $app->post('/userAvatar.file', function ($request, $response) {
                var_dump($request->getAttribute('fileType'));
            })
                ->add(new \Fileshare\Middlewares\FileTypeMiddleware($container));
            $app->get('/logout.action', 'LogoutController:logout');
            $app->get('/tests/{testName}', 'TestsController:testsPage');
        })->add(new \Fileshare\Middlewares\SessionMiddleware($container));
    }
}
