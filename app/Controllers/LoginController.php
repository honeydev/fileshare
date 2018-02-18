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
        $user = $createUserService->createRegisteredUser($request->getAttribute('loginData'));
        $this->sessionService->createAuthorizedUserSession($user);
        $userData = $this->sessionModel->user->getAllProperties();
        return $response->withJson(['status' => 'success', 'loginData' => $userData], 200);
    }
}
