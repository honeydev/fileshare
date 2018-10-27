<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\{File, Avatar};
use Illuminate\Support\Facades\DB;
use \Fileshare\Helpers\SortLinksHelper;

class SearchPageController extends AbstractController
{
    /**
     * [$fileSearcher description]
     * @property \Fileshare\Searchers\FileSearcher
     */
    private $fileSearcher;
    /**
     * @property \Fileshare\Services\AllowCursorValueCalculateService
     */
    private $allowCursorValueCalculateService;

    private $searchPaginator;


    public function __construct($container)
    {
        parent::__construct($container);
        $this->fileSearcher = $container->get('FileSearcher');
        $this->allowCursorValueCalculateService = $container->get('AllowCursorValueCalculateService');
        $this->selectFilesCountService = $container->get('SelectFilesCountService');
        $this->searchPaginator = $container->get('SearchPaginator');
    }

    public function search(Request $request, Response $response, $args)
    {
        $cursor = (int) $request->getAttribute('cursor');
        $requestFileName = $request->getParsedBody()['searchRequest'];
        $this->viewData['page'] = 'search';
        $this->viewData['fileArticles'] = $this->fileSearcher->search($requestFileName);
        $pagesCount = $this->allowCursorValueCalculateService->calculate(count($this->viewData['fileArticles']));
        $this->viewData['pagination'] = $this->searchPaginator->paginate($pagesCount, $cursor);
        $this->viewData['searchRequest'] = $requestFileName;
        return $this->container->view->render(
            $response,
            "index.twig",
            $this->viewData
        );
    }
}
