<?php

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Exceptions\DatabaseException;
use Fileshare\Exceptions\FileshareException;

class AddUserService
{
    /** @property \Fileshare\Db\models\Users */
    private $dbUser;

    private $cryptoService;

    public function __construct($container)
    {
        $this->db = $container->get('db');
        $this->dbUser = $container->get('Users');
        $this->cryptoService = $container->get('CryptoService');
    }

    public function addUser(array $userData)
    {
        $userData['hash'] = $this->cryptoService->getPasswordHash($userData['password']);
        $userData['id'] = $this->dbUser->addUserInUsers($userData);
        $this->dbUser->addUserSettings($userData);
        $this->ifNameExistAddNameInBase($userData);
    }

    protected function ifNameExistAddNameInBase(array $userData)
    {
        if (array_key_exists('name', $userData)) {
            $this->dbUser->addUserInfo([
                'name' => $userData['name'],
                'userId' => $userData['id']
                ]);
        }
    }
}
