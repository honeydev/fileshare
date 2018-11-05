<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Models\User;
use Fileshare\Transformers\UserTransformer;
use \Codeception\Util\Debug as debug;

class LoginController extends AbstractController
{
    private $loginAuth;
    private $cryptoService;

    public function __construct($container)
    {
        $this->container = $container;
        $this->loginAuth = $container->get('LoginAuth');
        $this->cryptoService = $container->get('CryptoService');
    }

    public function login(Request $request, Response $response)
    {
        $loginData = $request->getAttribute('loginData');
        $user = User::where('email', $loginData['email'])->first();
        $user->token =  $this->cryptoService->generateJwtToken(
            [
                "identifier" => $user->id,
                "appHost" => $this->container->get("settings")['appInfo']['hostname'],
                "secretKey" => $this->container->get("settings")['secretKey']
            ]
        );
        $user->save();
        $userData = UserTransformer::transform($user);
        return $response->withJson(['status' => 'success', 'loginData' => $userData], 200);
    }
}
