<?php

/**
 * @class OwnerMiddleware check equal user id and user id in base. 
 * if user category > 1, it is equal to the owner
 */
namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class OwnerMiddleware extends AbstractMiddleware
{
    public function __construct($container)
    {
        parent::__construct($container);
        $this->sessionModel = $container->get('SessionModel');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $profileData = $request->getAttribute('profileData');
        var_dump($profileData);
        if ($this->userIsOwner() || $this->userIsAdmin) {
            $response = $next($request, $response);
        } else {
            throw new AuthorizeException(`User not owner this data {$profileData}`);
        }
        return $response;
    }

    private function userIsOwner()
    {

    }

    private function userIsAdmin()
    {

    }
}
