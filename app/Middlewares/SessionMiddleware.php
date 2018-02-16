<?php

declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class SessionMiddleware extends AbstractMiddleware
{
    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $sessionService = $this->container->get('SessionService');
        $sessionService->run();
        $response = $next($request, $response);
        return $response;
    }
}
