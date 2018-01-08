<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class RegisteredController extends AbstractController
{
    public function registered(Request $request, Response $response)
    {
        $userData = $request->getAttribute('userData');
        $addUserService = $this->container->get('AddUserService');
        $addUserService->addUser($request->getAttribute('regData'));
        return $response->withJson(['status' => 'success'], 200);
    }
}
