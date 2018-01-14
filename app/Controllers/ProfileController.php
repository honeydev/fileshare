<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ProfileController extends AbstractController
{
    public function changeProfile(Request $request, Response $response)
    {
       return $response->withJson(['profileStatus' => 'success'], 200);
    }

    public function changeAvatar(Request $request, Response $response)
    {

    }
}
