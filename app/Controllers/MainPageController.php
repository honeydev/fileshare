<?php

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

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
        var_dump($request->getUploadedFiles());
    }

    public function regUser(Request $request, Response $response)
    {
        $userData = $request->getAttribute('userData');
        $addUserService = $this->container->get('AddUserService');
        $addUserService->addUser($request->getAttribute('regData'));
        return $response->withJson(['allowMessage' => 'user successfully added'], 200);
    }

    public function loginUser($request, $response)
    {
        $userService = $this->container->get('UserService', $request->getAttribute('userData'));
    }
}
