<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Routes
{
    public function startRoutes($app, $container)
    {
        $accessLogger = $container->get("AccessLogger");
        $secret = $container->get("settings")["secretKey"];
        $app->add(new \Slim\Middleware\JwtAuthentication([
            "secure" => false,
            "path" => [
                "/api/uploadavatar.file", 
                "/api/profile.form", 
                "/api/service/checkjwt"
            ],
            "logger" => $accessLogger,
            "secret" => $secret,
            "algorithm" => ["HS256"],
            "error" => function ($request, $response, $args) {

                return $response->withJson(["status" => "failed", "error" => $args["message"]], 500);
            }
        ]));

        $app->get('/', 'MainPageController:indexPage');
        $app->group('/api', function () use ($app, $container) {
            $app->post('/upload.file', 'MainPageController:uploadFile');
            $app->post('/login.form', 'LoginController:login')
                ->add(new \Fileshare\Middlewares\LoginAuthMiddleware($container))
                ->add(new \Fileshare\Middlewares\LoginValidateMiddleware($container));
            $app->post('/register.form', 'RegisteredController:registered')
                ->add(new \Fileshare\Middlewares\RegUserTypeMiddleware($container))
                ->add(new \Fileshare\Middlewares\RegValidateMiddleware($container));
            $app->post('/profile.form', 'ProfileController:changeProfile')
                ->add(new \Fileshare\Middlewares\ProfileValidateMiddleware($container))
                ->add(new \Fileshare\Middlewares\ProfileAccessMiddleware($container));
            $app->post('/uploadavatar.file', 'ProfileController:uploadAvatar')
                ->add(new \Fileshare\Middlewares\AvatarValidateMiddleware($container));

            $app->get('/service/checkjwt', 'ServiceController:checkJwt');
            $app->get('/logout.action', 'LogoutController:logout');
        });
        $app->get('/tests/{testName}', 'TestsController:testsPage');
    }
}
