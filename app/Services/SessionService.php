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

    public function runSession(array $clientEnvelopment)
    {
        $this->setSessionVariables($clientEnvelopment);
        var_dump('xhr status', $this->container->get('request'),  $this->container->get('request')->getHeaders());
    }

    private function setSessionVariables(array $clientEnvelopment)
    {
        if (!empty($_SESSION['sessionModel'])) {
            $this->sessionModel = $_SESSION['sessionModel'];
        } else {
            $this->createGuestSession($clientEnvelopment);
        }
    }

    private function createGuestSession(array $clientEnvelopment)
    {
        $this->sessionModel = $_SESSION['sessionModel'] = $this->container->get('SessionModel');
        $this->sessionModel->authorizeStatus = false;
        $this->sessionModel->accessLvl = 0;
        $this->sessionModel->user = $this->createUserService->createUser();
        $this->sessionModel->ip = $clientEnvelopment['ip'];
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
