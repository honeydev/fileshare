<?php

namespace Fileshare\Controllers;

abstract class AbstractController
{
    /** @property object */
    protected $sessionModel;

    public function __construct($container)
    {
        $this->container = $container;
        $this->sessionModel = $container->get('SessionModel');
        $this->sessionService = $container->get('SessionService');
    }
}
