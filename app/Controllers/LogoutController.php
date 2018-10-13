<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class LogoutController extends AbstractController
{
    public function logout(Request $request, Response $response)
    {
        return $response->withJson(['status' => 'success']);
    }
}
