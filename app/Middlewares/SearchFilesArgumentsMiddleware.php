<?php

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Exceptions\ValidateException;

class SearchFilesArgumentsMiddleware extends AbstractMiddleware
{
    /**
     * @var Fileshare\Validators\CursosValidator
     */
    private $cursorValidator;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->cursorValidator = $container->get('CursorValidator');
    }

    public function __invoke(Request $request, Response $response, $next): Response
    {
        try {
            $arguments = $request->getAttribute('routeInfo')[2];
            $arguments['cursor'] = intval($arguments['cursor'] ?? 1);
            $this->cursorValidator->validate($arguments['cursor']);
            $request = $request->withAttribute('cursor', $arguments['cursor']);
            $response = $next($request, $response);
            return $response;
        }  catch (ValidateException $e) {
            return $response->withRedirect('/404', 301);
        }
    }
}
