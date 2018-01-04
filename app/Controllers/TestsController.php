<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class TestsController extends AbstractController
{
    public function testsPage(Request $request, Response $response)
    {
        if ($this->container->get('settings')['development']) {
            $this->dataFromView = [
                'title' => 'Frontend tests',
                'showTests' => true
            ];
            $response = $this->container->view->render(
                $response, 
                "tests.twig", 
                $this->dataFromView
            );
        } else {
            define('HOST_URL', $request->getUri()->getHost());
            $this->dataFromView = [
                'title' => 'Frontend tests not available in production mode',
                'hostUrl' => HOST_URL,
                'showTests' => false
            ];

            $response = $this->container->view->render(
                $response, 
                "tests.twig", 
                $this->dataFromView
            );
        }
        return $response;
    }
}
