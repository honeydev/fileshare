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
    /** @array */
    protected $errorStack;

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;

        $this->debug = $this->container['settings']['displayErrorDetails'];
        $this->logging = $this->container['settings']['logging'];
        $this->logger = $this->container->get('logger');
    }

    protected function handleError($exception, Response $response)
    {
        $this->prepareErrorMessage($exception);
        $this->prepareStack($exception);
        $this->errorLog();
        return $response;
    }

    protected function showError(Response $response) {
        $this->container['view']->render(
            $response, 
            "index.twig", 
            [
                'page' => '500',
                'debug' => $this->debug,
                'errorInfo' => $this->errorMessage,
                'errorStack' => $this->errorStack
            ]
            );
        return $response;
    }

    protected function showWithJson(Response $response)
    {
        return $response->withJson([
            'page' => '500',
            'debug' => $this->debug,
            'errorInfo' => $this->errorMessage,
            'errorStack' => $this->errorStack
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
            $this->container['logger']->error(implode(', ', $this->errorMessage));
        }
    }
    
    protected function prepareErrorMessage($exception) 
    {
        $errorMessage = [];
        $errorMessage['error'] = $exception->getMessage();
        $errorMessage['code'] = $exception->getCode();
        $errorMessage['file'] = $exception->getFile();
        $errorMessage['line'] = $exception->getLine();
        $this->errorMessage = $errorMessage;
    }

    protected function prepareStack($exception)
    {
        $this->errorStack = explode('#', $exception->getTraceAsString());
    }
}
