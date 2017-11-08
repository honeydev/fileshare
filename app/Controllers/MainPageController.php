<?php

namespace Fileshare\Controllers;

use Fileshare\Exceptions\FileshareException;

class MainPageController extends AbstractController
{
    public function indexPage($request, $response)
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

    public function uploadFile($request, $response)
    {

    }

    public function regUser($request, $response)
    {
        ini_set('display_errors',1);
        error_reporting(E_ALL);
        echo 'reg user'
        $addUserService = $this->container->get('AddUserService');
        //$addUserService->addUser($request->getAttribute('regData'));
    }
}
