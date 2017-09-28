<?php
/**
 * session service - start session, create and manage session model
 */

namespace Fileshare\Services;

class SessionService
{
    private $sessionModel;
    private $cookieService;
    private $sessionDestroyer;
    private $container;

    public function __construct($container)
    {
        session_start();
        $this->container = $container;
        $this->sessionModel = $container->get('SessionModel', $container);
        // $this->cookieService = $container->get('CookieService');
    }

    public function destroySession() 
    {
        $this->sessionModel->deleteSessionData();
    }
}
