<?php
/**
 * @class CreateUserService provide methods to create object implements @interface  UserIntterface
 */

namespace Fileshare\Services;

use Fileshare\Models\UserInterface as UserInterface;

class CreateUserService
{
    /** @property \Fileshare\Models\UserInterface */
    private $user;
    /** @property \Fileshare\Db\models\User */
    private $dbUser;

    private $container;

    private $sessionService;

    public function __construct($container)
    {
        $this->container = $container;
        $this->dbUser = $this->container->get('User');
    }

    public function createGuest(): UserInterface
    {
        return $this->container->get('GuestUserModel');
    }

    public function createRegisteredUser(array $loginData): UserInterface
    {
        $userData = $this->dbUser->selectConcreteUserData($loginData['id']);
        $user = $this->createConcretUserAccordAccessLvl($userData['accessLvl']);
        $user->setUserVars($userData);
        return $user;
    }

    private function createConcretUserAccordAccessLvl(string $accessLvl): UserInterface
    {
        if ($accessLvl == 1) {
            $user = $this->container->get('RegularUserModel');
        } elseif ($accessLvl == 2) {
            $user = $this->container->get('AdminUserModel');
        } else {
            throw new \UnexpectedValueException("Incorrect accessLvl {$accessLvl} in class " . get_class());
        }
        return $user;
    }
}
