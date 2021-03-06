<?php

namespace Fileshare;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Routes
{
    public function start($app, $container)
    {
        $accessLogger = $container->get("AccessLogger");
        $secret = $container->get("settings")["secretKey"];
        $app->add(new \Slim\Middleware\JwtAuthentication([
            "secure" => false,
            "path" => [
                '/file/delete/',
                "/api/uploadavatar.file", 
                "/api/profile.form", 
                "/api/service/checkjwt",
                "/api/uploadfile/registred.file",
            ],
            "logger" => $accessLogger,
            "secret" => $secret,
            "algorithm" => ["HS256"],
            "error" => function ($request, $response, $args) {
                if ($request->isXhr()) {
                    return $response->withJson(["status" => "failed", "error" => $args["message"]], 500);
                } else {
                    return $response->withRedirect('/404', 301);
                }
            }
        ]));
        $app->get('/', 'MainPageController:indexPage');
        $app->get('/file/{fileName}', 'FilePageController:filePage');
        $app->get('/file/get/{fileName}', 'FilePageController:getFile');
        $app->get('/browse[/{sortType}[/{cursor}]]', 'BrowseFileController:browse')
            ->add(new \Fileshare\Middlewares\BrowseFilesArgumentsMiddleware($container));
        $app->get('/search', 'SearchPageController:search')
            ->add(new \Fileshare\Middlewares\SearchFilesArgumentsMiddleware($container));
        $app->group('/api', function () use ($app, $container) {
            $app->post('/uploadfile/anonym.file', 'MainPageController:uploadFileAnonym')
                ->add(new \Fileshare\Middlewares\FileValidationMiddleware($container));
            $app->post('/uploadfile/registred.file', 'MainPageController:uploadFileRegistred')
                ->add(new \Fileshare\Middlewares\FileValidationMiddleware($container));
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
        $app->get('/401', 'ServiceController:unauthorized');
    }
}
