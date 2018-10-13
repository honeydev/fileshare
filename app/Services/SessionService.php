<?php
/**
 * @class SessionService - start session, create and manage session model
 */
declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Models\UserInterface as UserInterface;

class SessionService
{
    private $container;
    private $sessionModel;
    private $userService;

    public function __construct($container)
    {
        $this->createSession();
        $this->container = $container;
    }

    public function run()
    {
        $this->setSessionVariables();
    }

    private function setSessionVariables()
    {
        if (!empty($_SESSION['sessionModel'])) {
            $this->sessionModel = $_SESSION['sessionModel'];
        } else {
            $this->createGuestSession();
        }
    }

    private function createGuestSession()
    {
        $this->sessionModel = $_SESSION['sessionModel'] = $this->container->get('SessionModel');
        $this->sessionModel->authorizeStatus = false;
        $this->sessionModel->accessLvl = 0;
        $this->sessionModel->ip = $this->container->get('request')->getServerParam('REMOTE_ADDR');
    }

    public function createAuthorizedUserSession(UserInterface $user)
    {
        $this->sessionModel = $_SESSION['sessionModel'] = $this->container->get('SessionModel');
        $this->sessionModel->authorizeStatus = true;
        $this->sessionModel->accessLvl = $user->accessLvl;
        $this->sessionModel->user = $user;
        $this->sessionModel->ip = $this->container->get('request')->getServerParam('REMOTE_ADDR');
    }

    private function createSession()
    {
        session_start();
    }

    public function destroySession() 
    {
        session_destroy();
        $_SESSION = [];
        $this->sessionModel->destroySessionData();
    }
}
