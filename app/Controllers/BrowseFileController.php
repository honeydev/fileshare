<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\File;
use Illuminate\Support\Facades\DB;
use \Fileshare\Helpers\SortLinksHelper;

class BrowseFileController extends AbstractController
{
    /**
     * @property \Fileshare\Services\SelectFilesService
     */
    private $selectFilesService;
    /**
     * @property \Fileshare\Services\AllowCursorValueCalculateService
     */
    private $allowCursorValueCalculateService;

    private $paginationService;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->selectFilesService = $container->get('SelectFilesService');
        $this->allowCursorValueCalculateService = $container->get('AllowCursorValueCalculateService');
        $this->paginationService = $container->get('PaginationService');
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
        $sortType = $request->getAttribute('sortType');
        $cursor = intval($request->getAttribute('cursor'));
        $pagesCount = $this->allowCursorValueCalculateService->calculate();
        $this->viewData['page'] = 'browse';
        $this->viewData['fileArticles'] = $this->selectFilesService->select($sortType, $cursor);
        $this->viewData['sortType'] = $sortType;
        $this->viewData['sortLinks'] = SortLinksHelper::getLinks($cursor);
        $this->viewData['cursor'] = $cursor;
        $this->viewData['pagination'] = $this->paginationService->preparePagination($pagesCount, $cursor);
        return $this->container->view->render(
            $response,
            "index.twig",
            $this->viewData
        );
    }
}
