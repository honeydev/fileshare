<?php
/**
 * @class BrowseFilesMiddleware detect and correct request on browse files
 */
declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\ValidateException as ValidateException;
use \Codeception\Util\Debug as debug;

class BrowseFilesMiddleware extends AbstractMiddleware
{

    public function __construct($container)
    {
        parent::__construct($container);

    }

    public function __invoke(Request $request, Response $response, $next)
    {
        var_dump($request->getAttributes('routeInfo')[2]);
        exit();
    }
}
