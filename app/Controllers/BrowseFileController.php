<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\File;
use Illuminate\Support\Facades\DB;

class BrowseFileController extends AbstractController
{
    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function index(Request $request, Response $response, array $args): Response
    {
        $this->viewData['page'] = 'browse';

        $response = $this->container->view->render(
            $response, 
            "index.twig", 
            $this->viewData
            );
        return $response;
    }

    public function browse(Request $request, Response $response, array $args)
    {
        $files = File::raw('SELECT * FROM files WHERE id NOT IN (SELECT parentId FROM avatars) LIMIT 2')->get();
        // var_dump($files);
        // $files = File::simplePaginate(1);
        // var_dump($files->toArray()['data']);
        return $response->withJson(["status" => "success", "files" => $files], 200);
    }
}