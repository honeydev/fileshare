<?php

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Exceptions\ValidateException;
use Fileshare\Filters\HtmlCharsFilter;

class SearchFilesArgumentsMiddleware extends AbstractMiddleware
{
    /**
     * @var Fileshare\Validators\CursosValidator
     */
    private $cursorValidator;

    /**
     * @property \Fileshare\Validators\SearchRequestValidator
     */
    private $searchRequestValidator;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->cursorValidator = $container->get('CursorValidator');
        $this->searchRequestValidator = $container->get('SearchRequestValidator');
    }

    public function __invoke(Request $request, Response $response, $next): Response
    {
        try {
            $arguments = $request->getQueryParams();
            $cursor = intval($arguments['page'] ?? 1);
            $searchRequest = $arguments['searchRequest'];
            $this->searchRequestValidator->validate($searchRequest);
            $this->cursorValidator->validate($cursor);
            $request = $request->withAttribute('cursor', $cursor);
            $request = $request->withAttribute('searchRequest', $searchRequest);
            $response = $next($request, $response);
            return $response;
        }  catch (ValidateException $e) {
            $this->logger->errorLog($e->getMessage());
            return $this->container->view->render(
                $response,
                "index.twig",
                [
                    'page' => 'user_error',
                    'errorMessage' => $e->getMessage()
                ]
            )->withStatus(400);
        }
    }
}
