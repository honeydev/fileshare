<?php

namespace Fileshare\Controllers;

abstract class AbstractController
{
    /**
     *@property {array} viewData
     */
    protected $viewData = [];

    public function __construct($container)
    {
        $this->container = $container;
        $this->viewData = array_merge($this->viewData, $container->get('settings')['appInfo']);
        $this->viewData['faviconLink'] = $container->get('settings')['favicon'];
    }
}
