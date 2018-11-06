<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Codeception\Util\Debug as debug;

class ServiceController extends AbstractController
{
    // if token expire slim jwt middleware return failed response
    public function checkJwt(Request $request, Response $response)
    {
        return $response->withJson(["status" => "success"], 200);
    }

    public function unauthorized(Request $request, Response $response)
    {
        $this->viewData['page'] = '401';
        return $this->container->view->render(
            $response,
            "index.twig",
            $this->viewData
        );
    }
}
