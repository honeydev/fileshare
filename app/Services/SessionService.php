<?php
/**
 * @class SessionService - start session, create and manage session model
 */

namespace Fileshare\Services;

class SessionService
{
    private $container;
    private $sessionModel;
    private $userService;

    public function __construct($container)
    {
        $this->createSession();
        $this->container = $container;
        $this->createUserService = $container->get('CreateUserService', $container);
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
        $this->accessLvl = 0;
        $this->user = $this->createUserService->createUser();
        $this->ip = $_SERVER['REMOTE_ADDR'];
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
