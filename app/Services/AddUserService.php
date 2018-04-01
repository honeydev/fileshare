<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Codeception\Util\Debug as debug;

class AddUserService
{

    private $cryptoService;

    public function __construct($container)
    {
        $this->users = $container->get('Users');
        $this->usersInfo = $container->get('UsersInfo');
        $this->usersSettings = $container->get('UsersSettings');
        $this->cryptoService = $container->get('CryptoService');
    }

    public function addUser(array $userData)
    {
        $hash = $this->cryptoService->getPasswordHash($userData['password']);
        $id = $this->addInUsers(['email' => $userData['email'], 'hash' => $hash]);
        $this->addInUsersInfo($this->extractDataForUsersInfo($userData, $id));
        $this->addInUsersSettings(['access_lvl' => $userData['accessLvl'], 'user_id' => $id]);
    }

    private function addInUsers(array $dataForUsers): int
    {
        $user = $this->users::create($dataForUsers);
        return $user->id;
    }

    private function addInUsersInfo(array $dataForUsersInfo)
    {
        if ($existUserInfo = count($dataForUsersInfo) > 1) {
            $this->usersInfo::create($dataForUsersInfo);
        }
    }

    private function extractDataForUsersInfo(array $userData, int $id): array
    {
        $result = [];

        if (array_key_exists('name', $userData)) {
            $result['name'] = $userData['name'];
        }
        
        $result['user_id'] = $id;
        return $result;
    }

    private function addInUsersSettings(array $dataForUsersSettings)
    {
        $this->usersSettings::create($dataForUsersSettings);
    }
}
