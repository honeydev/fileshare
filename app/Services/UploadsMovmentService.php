<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Codeception\Util\Debug as debug;
use \Fileshare\Exceptions\IOException;
use \Slim\Http\UploadedFile;

class UploadsMovmentService
{
    /**
     * @property string
     */
    private $storageDir;
    /**
     * @property \Fileshare\Services\CryptoService
     */
    private $cryptoService;

    public function __construct($container)
    {
        $this->storageDir = dirname(dirname(__DIR__)) . "/storage";
        $this->cryptoService = $container->get("CryptoService");
    }
    /**
     * @throws \Fileshare\Exceptions\IOException
     */
    public function movment(UploadedFile $file, array $params): array
    {
        $ownerFolder = $params["owner"]->email;
        $targetDir = "{$this->storageDir}{$params['category']}/{$ownerFolder}";

        $this->createDir($targetDir);
        $this->checkMovmentAvailability($file, $targetDir);

        $name = $this->cryptoService->getUniqueMd5Token() . "_" . $file->getClientFilename();
        $moveName = "{$targetDir}/{$name}";
        $shortUri = "/storage{$params['category']}/{$ownerFolder}/{$name}";
        $file->moveTo($moveName);
        return [
            "name" => $name,
            "uri" => $shortUri,
            "size" => $file->getSize(),
            "mime" => $file->getClientMediaType()
        ];
    }

    private function checkMovmentAvailability($file, $targetDir)
    {
        if ($file->getError() !== UPLOAD_ERR_OK) {
            throw new IOException("Has upload Error " . $file->getError());
        }

        if (!is_writable($targetDir)) {
            throw new IOException("There is no write access to directory {$this->storageDir}");
        }
    }

    private function createDir(string $directory)
    {
        if (!file_exists($directory)) {
            if (!mkdir($directory, 0777, true)) {
                throw new IOException("Can't create directory {$directory}");
            }
        }
    }
}
