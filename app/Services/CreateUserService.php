<?php
/**
 * @class CreateUserService provide methods to create object implements @interface  UserIntterface
 */

namespace Fileshare\Services;

use Fileshare\CRUDs\UsersInfoCRUDs;
use Fileshare\Models\UserInterface;

class CreateUserService
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

    /**
     * @param null|array
     * @return object
     */
    public function createUser($loginData = null): UserInterface
    {
        $this->createConcretUser($loginData);
        return $this->user;
    }
    /**
     * @param {null|array}
     */
    private function createConcretUser($loginData = null)
    {
        if ($userLoggedIn = !empty($loginData)) {
            $userData = $this->selectConcreteUserData($loginData['id']);
            $this->createConcretUserAccordAccessLvl($userData);
            $this->user->setUserVars($userData);
        } elseif ($userObjectExistInSession = !empty($this->sessionModel->user)) {
            $this->user = $this->sessionModel->user;
        } elseif ($guestFirstTimeLoadPage = !$this->sessionModel->authorizeStatus) {
            $this->user = $this->container->get('GuestUserModel');
        } else {
            throw new \LogicException('None of the condition is not satisfied in ' . get_class());
        }
    }
    /** @return void */
    private function createConcretUserAccordAccessLvl($userData)
    {
        if ($userData['accessLvl'] == 1) {
            $this->user = $this->container->get('RegularUserModel', $userData);
        } elseif ($userData['accessLvl'] == 2) {
            $this->user = $this->container->get('AdminUserModel', $userData);
        } else {
            throw new \UnexpectedValueException("Incorrect accessLvl {$userData['accessLvl']} in class " . get_class());
        }
    }
}