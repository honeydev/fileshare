<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 16/11/17
 * Time: 22:24
 */

namespace Fileshare\Handlers;


class JsonPhpErrorHandler extends AbstractHandler
{
    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function __invoke(Request $request, Response $response, $exception)
    {
        return $this->handleError($exception, $response);
    }

    protected function handleError($exception, Response $response)
    {
        parent::handleError($exception, $response);
        $response = $this->showError($response);
        $response = $this->setResponseMeta($response);
        return $response;
    }
}