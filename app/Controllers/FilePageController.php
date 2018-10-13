<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\User;
use \Fileshare\Models\File;
use \Fileshare\Transformers\UserTransformer;
use \Fileshare\Transformers\FileTransformer;
use \GuzzleHttp\Psr7\LazyOpenStream;

class FilePageController extends AbstractController
{
    /**
     * @property \Fileshare\Services\FileAvatarService
     */
    private $fileAvatarService;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->fileAvatarService = $container->get("FileAvatarService");
    }

    public function filePage(Request $request, Response $response, array $args)
    {
        $fileName = $args['fileName'];
        $file = File::getFileByName($fileName);
        $fileArray = FileTransformer::transform($file);
        // $fileArray['fileAvatar'] = $this->fileAvatarService->getFileAvatar($file);
        $ownerArray = UserTransformer::transform($file->owner);
        $this->viewData['file'] = $fileArray;
        $this->viewData['title'] = "{$this->viewData['appName']} - {$file->name}";
        $this->viewData['page'] = "file";
        $this->viewData['owner'] = $ownerArray;
        return $this->container->view->render(
            $response,
            "index.twig",
            $this->viewData
            );
    }

    public function getFile(Request $request, Response $response, array $args)
    {
       $fileName = $args['fileName'];
       $file = File::getFileByName($fileName);
       $appFolder = $this->container->get('settings')['appFolder'];
       $pathToFile = $appFolder . $file->uri;
       $newStream = new LazyOpenStream($pathToFile, 'r');
       return $response->withBody($newStream)
            ->withHeader('Content-Type', 'application/download')
            ->withHeader('Content-Length', $newStream->getSize());
    }
}
