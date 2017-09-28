<?php

namespace Fileshare\Controllers;

abstract class AbstractController
{
    protected $container;
    protected $sessionService;

    public function __construct($container)
    {
        $this->container = $container;
        $this->sessionService = $container->get('SessionService', $this->container);
    }
}
