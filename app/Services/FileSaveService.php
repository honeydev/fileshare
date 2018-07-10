<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Codeception\Util\Debug as debug;
use \Fileshare\Exceptions\IOException;
use \Slim\Http\UploadedFile;
use \Fileshare\Models\File;
use \Fileshare\Models\Avatar;
use \Fileshare\Models\FileToken;

class FileSaveService
{
    /**
     * @property string
     */
    private $storageDir;

    /**
     * @property \Fileshare\Services\UploadsMovmentService
     */
    private $uploadsMovmentService;

    public function __construct($container)
    {
        $this->cryptoService = $container->get("CryptoService");
        $this->uploadsMovmentService = $container->get('UploadsMovmentService');
        $this->storageDir = dirname(dirname(__DIR__)) . "/storage";
    }

    public function save(UploadedFile $file, array $params): string
    {
        $avatarToken = $this->cryptoService->getUniqueMd5Token();
        $fileAttributes = $this->uploadsMovmentService->movment($file, $params);
        $file = new File($fileAttributes);
        $file->save();
        $fileToken = FileToken::create(
            [
                "token" => $avatarToken, 
                "fileId" => $file->id
            ]
        );
        $fileToken->save();
        return $avatarToken;
    }

    public function confirmFile(string $token)
    {
        retrun $response->withJson(["status" => "success"])
    }
}
