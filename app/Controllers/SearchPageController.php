<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Packers\FilePacker;

class SearchPageController extends AbstractController
{
    /**
     * @property \Fileshare\Searchers\FileSearcher
     */
    private $fileSearcher;
    /**
     * @property \Fileshare\Services\AllowCursorValueCalculateService
     */
    private $allowCursorValueCalculateService;
    /**
     * @property \Fileshare\Paginators\SearchPaginator
     */
    private $searchPaginator;
    /**
     * @property \Fileshare\Services\SliceFilesQueryService
     */
    private $sliceFilesQueryService;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->fileSearcher = $container->get('FileSearcher');
        $this->allowCursorValueCalculateService = $container->get('AllowCursorValueCalculateService');
        $this->selectFilesCountService = $container->get('SelectFilesCountService');
        $this->searchPaginator = $container->get('SearchPaginator');
        $this->sliceFilesQueryService = $container->get('SliceFilesQueryService');
    }

    public function search(Request $request, Response $response, $args)
    {
        $this->viewData['page'] = 'search';
        $cursor = (int) $request->getAttribute('cursor');
        $searchRequest = $request->getAttribute('searchRequest');
        $searchQuery = $this->fileSearcher->search($searchRequest, $cursor);
        $pagesCount = $this->allowCursorValueCalculateService->calculate($searchQuery->count());
        $searchQuery = $this->sliceFilesQueryService->slice($searchQuery, $cursor);
        $this->viewData['fileArticles'] = FilePacker::pack($searchQuery->get());
        $this->viewData['pagination'] = $this->searchPaginator->paginate($cursor, $pagesCount, ['searchRequest' => $searchRequest]);
        $this->viewData['searchRequest'] = $searchRequest;
        return $this->container->view->render(
            $response,
            "index.twig",
            $this->viewData
        );
    }
}
