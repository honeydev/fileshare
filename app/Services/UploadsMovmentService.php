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

    public function __construct()
    {
        $this->storageDir = dirname(dirname(__DIR__)) . "/storage";
    }
    /**
     * @throws \Fileshare\Exceptions\IOException
     */
    public function movment(UploadedFile $file, array $params): array
    {
        $ownerEmail = $params["owner"]->email;
        $targetDir = "{$this->storageDir}{$params['category']}/{$ownerEmail}";
        $this->createDir($targetDir);

        if ($file->getError() !== UPLOAD_ERR_OK) {
            throw new IOException("Has upload Error " . $file->getError());
        }

        if (!is_writable($targetDir)) {
            throw new IOException("There is no write access to directory {$this->storageDir}");
        }

        $name = $file->getClientFilename();
        $moveName = "{$targetDir}/{$name}";
        $file->moveTo($moveName);
        return [
            "name" => $name,
            "uri" => $moveName,
            "size" => $file->getSize(),
            "mime" => $file->getClientMediaType()
        ];
    }

    private function createDir(string $directory)
    {
        if (!file_exists($directory)) {
            if (!mkdir($directory, 777, true)) {
                throw new IOException("Can't create directory {$directory}");
            }
        }
    }
}
