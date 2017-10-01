<?php
/**
 * @class SessionService - start session, create and manage session model
 */

namespace Fileshare\Services;

class SessionService
{
    private $container;
    private $sessionModel;

    public function __construct($container)
    {
        $this->createSession();
        $this->container = $container;
        $this->sessionModel = $container->get('SessionModel', $container);
        $this->setSessionVariables();
    }

    private function setSessionVariables()
    {
        if (!$this->sessionVarsExists()) {
            $_SESSION['authorizeStatus'] = false;
            $_SESSION['accessLvl'] = 0;
        }
        $this->sessionModel->authorizeStatus = $_SESSION['authorizeStatus'];
        $this->sessionModel->accessLvl = $_SESSION['accessLvl'];
        $this->sessionModel->ip = $_SERVER['REMOTE_ADDR'];
    }

    private function sessionVarsExists()
    {
        if (array_key_exists('$authorizeStatus', $_SESSION) &&
        array_key_exists('accessLvl', $_SESSION) &&
        array_key_exists('ip', $_SESSION)) {
            return true;
        }
        return false;
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
