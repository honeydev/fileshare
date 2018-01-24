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
    private $sessionModel;

    public function __construct($container)
    {
        $this->container = $container;
        $this->sessionModel = $container->get('SessionModel');
        $this->prepareErrorHelper = $container->get('PrepareErrorHelper');
        $this->logger = $container->get('Logger');
    }

    protected function userAlreadyAuthorized()
    {
        if ($this->sessionModel->authorizeStatus) {
            throw new FileshareException('User already authorized');
        }
    }

    protected function sendErrorWithJson($errorElements, $response)
    {
        $error = [
                'status' => 'failed',
                'errorType' => $errorElements['errorType']
            ];

        if (true) {
            $error = array_merge($error, $this->prepareErrorHelper->prepareErrorAsArray($errorElements['exception']));
        }
        return $response->withJson($error, $errorElements['errorCode']);
    }
}
