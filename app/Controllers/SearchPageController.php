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

    public function __construct($container)
    {
        parent::__construct($container);
        $this->fileSearcher = $container->get('FileSearcher');
    }

    public function search(Request $request, Response $response, $args)
    {
        $this->page['page'] = 'search';
        $requestFileName = $request->getParsedBody()['searchRequest'];
        $this->viewData['searchResult'] = $this->fileSearcher->search($requestFileName);
        return $this->container->view->render(
            $response,
            "index.twig",
            $this->viewData
        );
    }
}
