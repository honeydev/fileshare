<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 07/11/17
 * Time: 21:47
 */

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Exceptions\DatabaseException;
use Fileshare\Exceptions\FileshareException;

class AddUserService
{
    use \Fileshare\CRUDs\UsersCRUDs;
    use \Fileshare\CRUDs\UsersSettingsCRUDs;
    use \Fileshare\CRUDs\UsersInfoCRUDs {
        \Fileshare\CRUDs\UsersInfoCRUDs::__construct as initUsersInfoCRUDs;
    }

    private $cryptoService;

    public function __construct($container)
    {
        $this->db = $container->get('db');
        $this->cryptoService = $container->get('CryptoService');
        $this->initUsersInfoCRUDs($container);
    }

    public function addUser(array $userData)
    {
        $userData['hash'] = $this->cryptoService->getPasswordHash($userData['password']);
        $userData['id'] = $this->addUserInUsers($userData);
        $this->addUserSettings($userData);
        $this->ifNameExistAddInBase($userData);
    }

    protected function ifNameExistAddInBase(array $userData)
    {
        if (array_key_exists('name', $userData)) {
            $this->addUserInfo(['name' => $userData['name']]);
        }
    }
}
