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
    private $id;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->sessionModel = $container->get('SessionModel');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $this->id = $request->getParsedBody()['id'];
        $this->userCanChangeData();
        $response = $next($request, $response);
        return $response;
    }
    /**
     * @throws \Fileshare\Exceptions\AccessException
     */
    private function userCanChangeData()
    {
        if (!$this->userIsOwner() && !$this->userIsAdmin()) {
            throw new \Fileshare\Exceptions\AccessException('User can\'t change this matherial');
        }
    }

    private function userIsOwner(): bool
    {
        return $this->id === $this->sessionModel->user->id;
    }

    private function userIsAdmin(): bool
    {
        return $this->sessionModel->accessLvl > 1;
    }
}
