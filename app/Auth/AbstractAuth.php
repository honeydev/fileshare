<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 8:33 PM
 */

namespace Fileshare\Auth;

abstract class AbstractAuth
{
    protected $container;
    protected $logger;

    public function __construct($container)
    {
        $this->container = $container;
        $this->logger = $container->get('logger');
    }

    abstract public function auth($dataToCheck);
}
