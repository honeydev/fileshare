<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\User;
use \Fileshare\Models\File;

class FilePageController extends AbstractController
{

    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function getFile(Request $request, Response $response, array $args)
    {
       $args['fileName'];
       var_dump($fileName);
    }
}
