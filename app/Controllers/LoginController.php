<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class LoginController extends AbstractController
{
    public function login(Request $request, Response $response)
    {
        $createUserService = $this->container->get('CreateUserService');
        $userData = $createUserService->createUser($request->getAttribute('loginData'))->getAllProperties();
        return $response->withJson(['loginStatus' => 'success', 'loginData' => $userData], 200);
    }
}
