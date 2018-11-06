<?php

declare(strict_types=1);

namespace Fileshare\Middlewares;

use Fileshare\Exceptions\AuthException;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Models\{User, File};

class FileDeleteAuthMiddleware extends AbstractMiddleware
{
    /**
     * @property \Fileshare\Auth\FileAuth
     */
    private $fileAuth;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->fileAuth = $container->get("FileAuth");
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $arguments = $request->getAttribute('routeInfo')[2];
        $jwt = $request->getAttribute('tokken');
        $user = User::getUserById($jwt->sub);
        $file = File::getFileByName($arguments['fileName']);
        try {
            $this->fileAuth->auth(['user' => $user, 'file' => $file]);
            $response = $next($request, $response);
            return $response;
        } catch (AuthException $e) {
            $this->logger->authorizeLog($e->getMessage());
            return $response->withRedirect('/401', 301);
        }
    }
}
