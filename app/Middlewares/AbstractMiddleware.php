<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 9:17 PM
 */

namespace Fileshare\Middlewares;


abstract class AbstractMiddleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}