<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 16/11/17
 * Time: 22:24
 */

namespace Fileshare\Handlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class JsonPhpErrorHandler extends AbstractErrorHandler
{
    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function __invoke(Request $request, Response $response, $exception)
    {
        echo 'jsonRuntimeErrorHR';
        return $this->handleError($exception, $response);
    }

    protected function handleError($exception, Response $response)
    {
        parent::handleError($exception, $response);
        return $this->showWithJson($response);
    }
}