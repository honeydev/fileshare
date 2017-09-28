<?php

namespace Fileshare\Controllers;

use Fileshare\Exceptions\ErrorException;

class MainPageController extends AbstractController
{
    public function indexPage($request, $response)
    {
        $this->container->dataFromView = [
            'title' => 'Fileshare',
            'page' => 'main_page'
        ];

        $this->container['errorHandler']($request, $response, new ErrorException('privet kak dela', $this->container));
        $response = $this->container->view->render($response, "index.twig", $this->container->dataFromView);

        return $response;
    }

    public function uploadFile($request, $response)
    {

    }
}
