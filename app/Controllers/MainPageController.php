<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\User;

class MainPageController extends AbstractController
{
    /**
     * @property \Fileshare\Services\FileSaveService
     */
    private $fileSaveService;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->fileSaveService = $container->get("FileSaveService");
    }

    public function indexPage(Request $request, Response $response)
    {
        $this->viewData['page'] = 'main_page';
        $response = $this->container->view->render(
            $response, 
            "index.twig", 
            $this->viewData
            );

        return $response;
    }

    public function uploadFileAnonym(Request $request, Response $response)
    {
        $file = $request->getUploadedFiles()['file'];
        $fileType = $request->getAttribute("fileType");
        $owner = User::getUserByEmail("anonymous@fileshare");
        $file = $this->fileSaveService->save($file, [
            "owner" => $owner,
            "category" => "/uploads",
            "type" => $fileType
            ]
        );
        return $response->withJson(["status" => "success", "fileUrl" => "/file/{$file->name}"], 200);
    }

    public function uploadFileRegistred(Request $request, Response $response)
    {
        $jwt = $request->getAttribute("token");
        $file = $request->getUploadedFiles()['file'];
        $fileType = $request->getAttribute("fileType");
        $owner = User::getUserById($jwt->sub);
        $file = $this->fileSaveService->save($file, [
            "owner" => $owner,
            "category" => "/uploads",
            "type" => $fileType
        ]);
        return $response->withJson(["status" => "success", "fileUrl" => "/file/{$file->name}"], 200);
    }
}
