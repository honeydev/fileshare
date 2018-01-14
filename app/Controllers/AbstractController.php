<?php

namespace Fileshare\Controllers;

abstract class AbstractController
{
    /** @property [array] */
    protected $errorMessage;
    /** @property [array] */
    protected $errorStack;
    /** @property object */
    protected $sessionServce;

    public function __construct($container)
    {
        $this->container = $container;
    }
}
