<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

abstract class AbstractController
{
    /**
     * @property {array} viewData
     */
    protected $viewData = [];
    /**
     * @property Fileshare\Components\Logger
     */
    protected $logger;

    public function __construct($container)
    {
        $this->container = $container;
        $this->logger = $container->get('Logger');
        $this->viewData = array_merge($this->viewData, $container->get('settings')['appInfo']);
        $this->viewData['faviconLink'] = $container->get('settings')['favicon'];
        $this->viewData['title'] = $this->viewData['appName'];
    }
}
