<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class LoginController extends AbstractController
{
    public function login(Request $request, Response $response)
    {
        echo 'login user!!';
        $userService = $this->container->get('UserService', $request->getAttribute('userData'));
        return $response;
    }
}
