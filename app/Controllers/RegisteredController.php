<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\User;
use \Fileshare\Models\UserInfo;
use \Fileshare\Models\UserSettings;
use \Codeception\Util\Debug as debug;

class RegisteredController extends AbstractController
{
    /**
    * @property \Fileshare\Service\CryptoService
    */
    private $cryptoService;
    /**
     * @property string
     */
    private $hostUrl;

    public function __construct($container)
    {
        $this->cryptoService = $container->get('CryptoService');
        $this->hostUrl = $container->get('settings')['appInfo']['hostname'];
    }

    public function registered(Request $request, Response $response)
    {
        $userData = $request->getAttribute('regData');
        $user = new User([
            "email" => $userData['email'],
            "password" => $this->cryptoService->getPasswordHash($userData['password']),

        ]);
        $user->save();

        $userInfo = new UserInfo([
            "name" => $userData["name"]
        ]);

        $user->userInfo()->save($userInfo);

        $userSettings = new UserSettings(["accessLvl" => $userData["accessLvl"], "accountStatus" => 1]);
        $user->userSettings()->save($userSettings);

        return $response->withJson([
            'status' => 'success',
            "email" => $user->email,
            "name" => $user->userInfo->name,
            "accessLvl" => $user->userSettings->accessLvl,
            "id" => $user->id
        ], 200);
    }
}
