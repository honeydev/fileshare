<?php

/**
 * @class OwnerMiddleware check equal user id and user id in base. 
 * if user category > 1, it is equal to the owner
 */
declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class OwnerMiddleware extends AbstractMiddleware
{
    private $sessionModel;
    private $userId;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->sessionModel = $container->get('SessionModel');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $this->id = $request->getParsedBody()['id'];
        if ($this->userIsOwner() || $this->userIsAdmin()) {
            $response = $next($request, $response);
        } else {
            throw new AuthorizeException(`User not owner this data {$profileData}`);
        }
        return $response;
    }

    private function userIsOwner()
    {
        if ($this->id === $this->sessionModel->user->id) {
            return true;
        }
        return false;
    }

    private function userIsAdmin()
    {
        if ($this->sessionModel->accessLvl > 1) {
            return true;
        }
        return false;
    }
}
