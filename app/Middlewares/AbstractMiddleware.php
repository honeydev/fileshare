<?php

declare(strict_types=1);

namespace Fileshare\Middlewares;

use Fileshare\Exceptions\FileshareException as FileshareException;

abstract class AbstractMiddleware
{
    protected $container;
    protected $prepareErrorHelper;
    /** @property \Fileshare\Components\Logger */
    protected $logger;
    /**
     * @property array
     */
    protected $viewData = [];

    public function __construct($container)
    {
        $this->container = $container;
        $this->prepareErrorHelper = $container->get('PrepareErrorHelper');
        $this->logger = $container->get('Logger');
        $this->viewData = $this->viewData = array_merge($this->viewData, $container->get('settings')['appInfo']);
    }

    protected function sendErrorWithJson($errorElements, $response)
    {
        $error = [
            'status' => 'failed',
            'errorType' => $errorElements['errorType']
        ];

        if ($this->container->get('settings')['displayErrorDetails']) {
            $error = array_merge($error, $this->prepareErrorHelper->prepareErrorAsArray($errorElements['exception']));
        }

        return $response->withJson($error, $errorElements['errorCode']);
    }
}
