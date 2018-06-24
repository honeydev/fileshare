<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\User;
use \Fileshare\Transformers\UserTransformer;
use \Codeception\Util\Debug as debug;

class ProfileController extends AbstractController
{
    /**
     * @property \Fileshare\Services\UpdateUserService
     */
    private $updateUserService;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->updateUserService = $this->container->get("UpdateUserService");
    }

    public function changeProfile(Request $request, Response $response)
    {
        $requestData = $request->getParsedBody();
        $user = User::find($requestData['id']);
        $this->updateUserService->update(
            $user,
            $requestData
        );
        $responseUserData = UserTransformer::transform($user);
        return $response->withJson(['status' => 'success', 'user' => $responseUserData], 200);
    }

    public function uploadAvatar(Request $request, Response $response)
    {
        $token = md5((String) mt_rand());
        return $response->withJson(["status" => "success", "token" => $token]);
    }

    public function confirmAvatar(Request $request, Response $response)
    {

    }
}
