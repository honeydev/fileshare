<?php

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\AuthorizeException as AuthorizeException;
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
            $response = $this->sendErrorWithJson([
                'errorType' => 'Invalid registration data',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
        } catch (AuthorizeException $e) {
            $response = $this->sendErrorWithJson([
                'errorType' => 'Invalid registration data',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
        } finally {
            return $response;
        }
    }
}
