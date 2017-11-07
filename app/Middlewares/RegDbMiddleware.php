<?php

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\FileshareException as FileshareException;

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
            $regForm = $request->getParsedBody();
            $this->registerAuth->auth($regForm);
            $response = $next($request, $response);
        } catch (FileshareException $e) {
            $error = $this->prepareErrorToJsonSend($e, 'Registration failed');
            $response = $response->withJson($error, 401);
        } finally {
            return $response;
        }
    }
}
