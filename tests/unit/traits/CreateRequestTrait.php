<?php

declare(strict_types=1);

namespace FileshareTests\unit\traits;

use Psr\Http\Message\ServerRequestInterface as Request;

trait CreateRequestTrait
{
    private function createRequest($container, array $requestBody = array(), array $requestParams = array()): Request
    {
        $request = $container->get('request');
        $request = $request->withParsedBody($requestBody);
        $request = $this->addRequestParams($request, $requestParams);
        return $request;
    }

    private function addRequestParams(Request $request, array $requestParams): Request
    {
        foreach ($requestParams as $paramName => $paramValue) {
            $request = $request->withQueryParams($paramName, $paramValue);
        }
        return $request;
    }
}