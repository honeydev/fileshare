<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class MainPageController extends AbstractController
{
    public function indexPage(Request $request, Response $response)
    {
        $this->container->dataFromView = [
            'title' => 'Fileshare',
            'page' => 'main_page'
        ];

        $response = $this->container->view->render(
            $response, 
            "index.twig", 
            $this->container->dataFromView
            );

        return $response;
    }

    public function uploadFile(Request $request, Response $response)
    {
        var_dump($request->getUploadedFiles());
    }
}
