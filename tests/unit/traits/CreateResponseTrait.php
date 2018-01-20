<?php

declare(strict_types=1);

namespace FileshareTests\unit\traits;

use Psr\Http\Message\ResponseInterface as Response;

trait CreateResponseTrait
{
    private function createResponse($container): Response
    {
        $response = $this->container->get('response');
        return $response;
    }
}
