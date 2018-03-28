<?php
/**
 * @class CreateUserService provide methods to create object implements @interface  UserIntterface
 */

namespace Fileshare\Services;

use Fileshare\Models\UserInterface as UserInterface;
use \Fileshare\Transformers\CamelCaseKeyTransformer as CamelCaseKeyTransformer;

class CreateUserService
{
    /** @property \Fileshare\Models\UserInterface */
    private $user;
    /** @property \Fileshare\Db\ORM\Users */
    private $users;

    private $container;

    private $sessionService;
    /** @propery \Fileshare\Transformers\CamelCaseKeyTransformer */
    private $camelCaseKeyTransformer;

    public function __construct($container)
    {
        $this->container = $container;
        $this->users = $this->container->get('Users');
    }

    public function createGuest(): UserInterface
    {
        return $this->container->get('GuestUserModel');
    }

    public function createRegisteredUser(array $loginData): UserInterface
    {
        $userDb = $this->users->find($loginData['id']);
        $userData = \Fileshare\Db\Helpres\UsersHelper::getAllUserData();
        $userData = CamelCaseKeyTransformer::transform($userData);
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
