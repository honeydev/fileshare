<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 9:18 PM
 */

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class LoginMiddleware extends AbstractMiddleware
{
    private $loginAuth;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->loginAuth = $container->get('LoginAuth');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        if (!$this->loginAuth->auth($request->getParsedBody())) {
            $error = ['errorMessage' => 'Invalid Login data'];
            $response->withJson($error, 401);
        }
        return $response;
    }
}