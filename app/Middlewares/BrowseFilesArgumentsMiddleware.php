<?php

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Exceptions\InvalidRequestArgumentException;

class BrowseFilesArgumentsMiddleware extends AbstractMiddleware
{
    private $browseFilesArgumentsValidator;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->browseFilesArgumentsValidator = $container->get('BrowseFilesArgumentsValidator');
    }

    public function __invoke(Request $request, Response $response, $next): Response
    {
        try {
            $arguments = $request->getAttribute('routeInfo')[2];
            $arguments['sortType'] = $arguments['sortType'] ?? 'late_to_early';
            $arguments['cursor'] = $arguments['cursor'] ?? 1;
            $this->browseFilesArgumentsValidator->validate($arguments);
            $request = $request->withAttribute('sortType', $arguments['sortType']);
            $request = $request->withAttribute('cursor', $arguments['cursor']);
            $response = $next($request, $response);
            return $response;
        }  catch (InvalidRequestArgumentException $e) {
            return $response->withRedirect('/404', 301);
        }
    }
}
