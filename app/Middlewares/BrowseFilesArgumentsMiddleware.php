<?php

namespace Fileshare\Middlewares;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Exceptions\ValidateException;

class BrowseFilesArgumentsMiddleware extends AbstractMiddleware
{
    private $cursorValidator;

    private $sortTypeValidator;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->cursorValidator = $container->get("CursorValidator");
        $this->sortTypeValidator = $container->get("SortTypeValidator");
    }
    public function __invoke(Request $request, Response $response, $next): Response
    {
        try {
            $arguments = $request->getAttribute('routeInfo')[2];
            $arguments['sortType'] = $arguments['sortType'] ?? 'late_to_early';
            $arguments['cursor'] = $arguments['cursor'] ?? 1;
            $this->cursorValidator->validate((int) $arguments['cursor']);
            $this->sortTypeValidator->validate($arguments['sortType']);
            $request = $request->withAttribute('sortType', $arguments['sortType']);
            $request = $request->withAttribute('cursor', $arguments['cursor']);
            $response = $next($request, $response);
            return $response;
        }  catch (ValidateException $e) {
            return $response->withRedirect('/404', 404);
        }
    }
}