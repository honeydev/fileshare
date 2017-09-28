<?php

namespace Fileshare\Controllers;

abstract class AbstractController
{
    /** @property [array] */
    protected $errorMessage;
    /** @property [array] */
    protected $errorStack;

    public function __construct($container)
    {
        $this->container = $container;
        $this->sessionService = $container->get('SessionService', $this->container);
    }
}
