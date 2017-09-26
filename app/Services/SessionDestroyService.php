<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 9/11/17
 * Time: 9:54 PM
 */

namespace Fileshare\Services;

class SessionDestroyService
{
    private $sessionModel;

    public function __construct($container)
    {
        $this->sessionModel = $container->get('SessionModel');
    }

    public function deleteSessionData() {
        $this->sessionModel->destroySessionData();
        session_destroy();
    }
}