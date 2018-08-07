<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\User;
use \Fileshare\Models\File;
use \Fileshare\Transformers\UserTransformer;
use \GuzzleHttp\Psr7\LazyOpenStream;

class FilePageController extends AbstractController
{

    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function filePage(Request $request, Response $response, array $args)
    {
        $fileName = $args['fileName'];
        $file = File::getFileByName($fileName);
        $owner = UserTransformer::transform($file->owner);
        exit();
        return $this->container->view->render(
            $response,
            "index.twig",
            [
                'title' => "Fileshare {$file->name}", 
                "page" => "file", 
                "file" => $file->toArray(),
                "owner" => $owner
            ]
            );
    }

    public function getFile(Request $request, Response $response, array $args)
    {
       $fileName = $args['fileName'];
       $file = File::getFileByName($fileName);
       $appFolder = $this->container->get('settings')['appFolder'];
       $pathToFile = $appFolder . $file->uri;
       $newStream = new LazyOpenStream($pathToFile, 'r');
       return $response->withBody($newStream);
    }
}
