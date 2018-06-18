<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\User;
use \Fileshare\Transformers\NewProfileDataTransformer;
use \Fileshare\Transformers\UserTransformer;

class ProfileController extends AbstractController
{
    /**
    * \Fileshare\Atuh\ProfileAuth
    */
    private $profileAuth;

    public function changeProfile(Request $request, Response $response)
    {
        $requestData = $request->getParsedBody();
        $user = User::find($requestData['id']);
        $newProfileData = NewProfileDataTransformer::transform($requestData);

        foreach ($newProfileData as $key => $value) {
            $user->$key = $value;
        }

        $user->save();

        $responseUserData = UserTransformer::transform($user);
        return $response->withJson(['status' => 'success', 'user' => $responseUserData], 200);
    }

    public function changeAvatar(Request $request, Response $response)
    {

    }
}
