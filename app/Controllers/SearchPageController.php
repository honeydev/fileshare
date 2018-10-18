<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\File;
use Illuminate\Support\Facades\DB;
use \Fileshare\Helpers\SortLinksHelper;

class SearchPageController extends AbstractController
{
    public function __construct($container)
    {

    }

    public function search(Request $request, Response $response, $args)
    {
        var_dump(File::where('name', 'like', '%.jpg%')->get());
    }
}
