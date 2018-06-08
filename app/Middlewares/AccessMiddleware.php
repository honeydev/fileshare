<?php
/**
 * @class OwnerMiddleware check equal user id and user id in base.
 * if user category > 1, it is equal to the owner
 */
declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Codeception\Util\Debug as debug;

class AccessMiddleware extends AbstractMiddleware
{
    private $acl;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->acl = $container->get('ACL');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        debug::debug($requesty->getParsedBody());
    }
}
