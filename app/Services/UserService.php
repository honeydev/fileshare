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

        if ($userLoggedIn = !empty($loginData)) {
           $userData = $this->selectConcreteUserData($loginData['id']);
            $this->createConcretUserAccordAccessLvl($userData);
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
        if ($userData['accessLvl'] == 1) {
            return $this->container->get('RegularUserModel', $userData);
        } elseif ($userData['accessLvl'] == 2) {
            return $this->container->get('AdminUserModel', $userData);
        } else {
            throw new \UnexpectedValueException("Incorrect accessLvl {$userData['accessLvl']} in class " . get_class());
        }
    }
    /** @return void */
    private function setUserProperties(array $userData)
    {
        foreach ($userData as $property => $value) {
            $this->user->$property = $value;
        }
    }
}
