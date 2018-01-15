<?php
/**
 * @class SessionService - start session, create and manage session model
 */
declare(strict_types=1);

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
    }

    public function runSession()
    {
        $this->setSessionVariables();
        var_dump('xhr status', $this->container->get('request')->isXhr(),  $_SERVER);
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
        $this->sessionModel->user = $this->createUserService->createUser();
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
