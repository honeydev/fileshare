<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\File;
use Illuminate\Support\Facades\DB;

class BrowseFileController extends AbstractController
{
    /**
     * @property \Fileshare\Services\SelectFilesService
     */
    private $selectFilesService;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->selectFilesService = $container->get('SelectFilesService');
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
        $sortType = empty($args['sortType']) ? 'late_to_early' : $args['sortType'];
        $page = empty($args['cursor']) ? 1 : $args['cursor'];
        $this->viewData['page'] = 'browse';
        $this->viewData['files'] = $this->selectFilesService->select($sortType, $page);
        var_dump($this->viewData['files'][0]);
        return $this->container->view->render(
            $response,
            "index.twig",
            $this->viewData
        );
    }
}