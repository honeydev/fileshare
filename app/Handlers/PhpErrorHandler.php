<?php

declare(strict_types=1);

namespace Fileshare\Handlers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class PhpErrorHandler extends AbstractErrorHandler
{
    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function __invoke(Request $request, Response $response, $exception)
    {
        $this->prepareErrorMessage($exception);
        $this->prepareStack($exception);
        $this->errorLog();
        $response = $this->showError($response);
        $response = $this->setResponseMeta($response);
        return $response;
    }
}
