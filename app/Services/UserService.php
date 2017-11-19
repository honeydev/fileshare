<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 07/11/17
 * Time: 21:45
 */

namespace Fileshare\Services;

class UserService
{
    use \Fileshare\CRUDs\UsersCRUDs;

    private $user;
    private $sessionModel;
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
        $this->sessionModel = $this->container->get('SessionModel');
    }

    public function getUser($userData = null)
    {
        $this->setUser($userData);
        return $this->user;
    }

    private function setUser($userData)
    {
        //либо пользователь не авторизован, тогда создаем гостя
        //либо пользователь уже существует в сессии
        //если нет то значит к этому моменту уже произошла авторизациия
        //и мы создаем нового пользователя в зависимости от уровня его аккаунт
        if ($userObjectExistInSession = !empty($this->sessionModel->user)) {
            $this->user = $this->sessionModel->user;
        } elseif ($guestFirstTimeLoadPage = !$this->sessionModel->authorizeStatus) {
            $this->user = $this->container->get('GuestUserModel');
        } elseif ($userLoggedIn = !empty($userData)) {
            $this->user = $this->createConcretUserAccordAccessLvl($userData);
        } else {
            throw new \LogicException('None of the condition is not satisfied in ' . get_class());
        }
    }

    private function createConcretUserAccordAccessLvl($userData)
    {
        if ($accessLvl === 1) {
            return $this->container->get('RegularUserModel');
        } elseif ($accessKVk === 2) {
            return $this->container->get('AdminUserModel');
        } else {
            throw new \UnexpectedValueException("Incorrect accessLvl {$accessLvl} in class " . get_class());
        }
    }
}
