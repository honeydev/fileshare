<?php

declare(strict_types=1);

namespace Fileshare\Handlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class AbstractErrorHandler
{
    /** @boolean */
    protected $debug;
    /** @boolean */
    protected $logging;
    /** @array */
    protected $errorMessage;
    /** @property \Fileshare\Components\Logger */
    protected $logger;
    /** @property \Fileshare\Helpers\PrepareErrorHelper */
    protected $prepareErrorHelper;

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;

        $this->debug = $this->container['settings']['displayErrorDetails'];
        $this->logging = $this->container['settings']['logging'];
        $this->logger = $this->container->get('Logger');
        $this->prepareErrorHelper = $this->container->get('PrepareErrorHelper');
    }

    protected function handleError($exception, Response $response)
    {
        $this->errorMessage = $this->prepareErrorHelper->prepareErrorAsArray($exception);
        $this->logger->errorLog($this->prepareErrorHelper->prepareErrorAsString($exception));
        return $response;
    }

    protected function showError(Response $response) {
        $response = $response->withStatus(500);
        $this->container['view']->render(
            $response,
            "index.twig",
            [
                'status' => 'failed',
                'page' => '500',
                'debug' => $this->debug,
                'errorInfo' => $this->errorMessage,
                'errorStack' => $this->errorMessage['stackArray']
            ]
            );
        return $response;
    }

    protected function showWithJson(Response $response)
    {
        return $response->withJson([
            'status' => 'failed',
            'page' => '500',
            'debug' => $this->debug,
            'errorInfo' => $this->errorMessage,
            'errorStack' => $this->errorMessage['stackArray']
        ], 500);
    }

    protected function setResponseMeta(Response $response)
    {
        $response->withStatus(500);
        $response->withHeader('Content-Type', 'text/html');
        return $response;       
    }

    protected function errorLog()
    {
        if ($this->logging) {
            $this->container['logger']->error($this->errorMessage['stackString']);
        }
    }

    protected function prepareStack($exception)
    {
        $this->errorStack = explode('#', $exception->getTraceAsString());
    }
}
