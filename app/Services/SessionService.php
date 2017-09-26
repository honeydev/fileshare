<?php
/**
 * session service - start session, create and manage session model
 */

namespace Fileshare\Services;

class SessionService
{
    private $sessionModel;
    private $cookieService;
    private $container;
    private $sessionDestroyer;

    public function __construct($container)
    {
        session_start();
        $this->container = $container;
        $this->sessionModel = $container->get('SessionModel', $this->container);
        $this->cookieService = $container->get('CookieService');
        $this->sessionDestroyer = $container->get('SessionDestroyer');
    }

    public function destroySession() {
        $this->sessionDestroyer->deleteSessionData();
    }
}
