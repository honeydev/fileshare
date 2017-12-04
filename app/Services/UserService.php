<?php
/**
 * @class UserService provide methods to create object implements @interface  UserIntterface
 */

namespace Fileshare\Services;

use Fileshare\CRUDs\UsersInfoCRUDs;
use Fileshare\Models\UserInerface;

class UserService
{
    use \Fileshare\CRUDs\UsersCRUDs;
    use \Fileshare\CRUDs\UsersInfoCRUDs;
    use \Fileshare\CRUDs\UsersSettingsCRUDs;

    private $user;
    private $sessionModel;
    private $container;
    protected $db;

    public function __construct($container)
    {
        $this->container = $container;
        $this->sessionModel = $this->container->get('SessionModel');
        $this->db = $this->container->get('db');
    }

    public function getUser($loginData = null)
    {
        $this->createUser($loginData);
        return $this->user;
    }
    /**
     * @param {null|array}
     */
    private function createUser($loginData)
    {
        var_dump('login data', $loginData);
        if ($userLoggedIn = !empty($loginData)) {
            $userData = $this->agregateUserDataFromDb($loginData['id']);
            var_dump('ready user data', $userData);
           // $this->createConcretUserAccordAccessLvl($userData);
        } elseif ($userObjectExistInSession = !empty($this->sessionModel->user)) {
            $this->user = $this->sessionModel->user;
        } elseif ($guestFirstTimeLoadPage = !$this->sessionModel->authorizeStatus) {
            $this->user = $this->container->get('GuestUserModel');
        } else {
            throw new \LogicException('None of the condition is not satisfied in ' . get_class());
        }
    }

    private function createConcretUserAccordAccessLvl($userData)
    {
        if ($userData['accessLvl'] === 1) {
            return $this->container->get('RegularUserModel', $userData);
        } elseif ($userData['accessLvl'] === 2) {
            return $this->container->get('AdminUserModel', $userData);
        } else {
            throw new \UnexpectedValueException("Incorrect accessLvl {$userData['accessLvl']} in class " . get_class());
        }
    }

    private function agregateUserDataFromDb(string $userId): array
    {
        $userData = $this->selectUserData(['column' => 'id', 'value' => $userId]);
        var_dump('select user', $userData);
        var_dump('select user settings', $this->selectUserSettings(['column' => 'userId', 'value' => $userId]));
        var_dump('select usersinfo', $this->selectUserInfo(['column' => 'userId', 'value' => $userId]));
//        $userData = array_$merge($userData, $this->selectUserSettings(['column' => 'userId', 'value' => $userId]));
//        var_dump($userData);
        //$userData = array_merge($userData, $this->selectUserInfo(['identificatorType' => $userId]));
        return $userData;
    }
}
