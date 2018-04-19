<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class LoginController extends AbstractController
{
    private $loginAuth;

    public function __construct($container)
    {
        $this->container = $container;
        $this->loginAuth = $container->get('LoginAuth');
    }

    public function login(Request $request, Response $response)
    {
        $userData = $request->getAttribute('loginData');
        $user = EloquentModel::where('email', $email)->first();
        $user->token =  $this->loginAuth->generateToken();
        return $response->withJson(['status' => 'success', 'loginData' => $userData], 200);
    }
}
