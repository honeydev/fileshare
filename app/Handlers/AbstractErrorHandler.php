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

    protected $errorMessage;
    protected $errorStack;

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;

        $this->debug = $this->container['settings']['displayErrorDetails'];
        $this->logging = $this->container['settings']['logging'];
    }

    protected function showError($response) {
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

    protected function setResponseMeta($response)
    {
        $response->withStatus(500);
        $response->withHeader('Content-Type', 'text/html');
        return $response;       
    }

    protected function errorLog() 
    {
        if ($this->errorLog) {
            $this->contaner['logger']->error(
                implode(', ', $errorMessage)
                );
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
