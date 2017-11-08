<?php

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\FileshareException as FileshareException;
use Fileshare\Exceptions\DatabaseException as DatabaseException;

class RegDbMiddleware extends AbstractMiddleware
{
    private $registerAuth;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->registerAuth = $container->get('RegisterAuth');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        try {
            $regData = $request->getAttribute('regData');
            $this->registerAuth->auth($regData);
            $response = $next($request, $response);
        } catch (DatabaseException $e) {
            echo 'db excep';
            $error = $this->prepareErrorToJsonSend($e, 'Registration failed');
            $response = $response->withJson($error, 401);
        } finally {
            return $response;
        }
    }
}
