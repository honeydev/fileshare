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
        if ($file->getError() !== UPLOAD_ERR_OK) {
            throw new IOException("Has upload Error " . $file->getError());
        }

        if (!is_writable($this->storageDir)) {
            throw new IOException("There is no write access to directory {$this->storageDir}");
        }

        $name = $file->getClientFilename();
        $moveName = $this->storageDir . "{$params['category']}/{$name}";
        $file->moveTo($moveName);
        return [
            "name" => $name,
            "uri" => $moveName,
            "size" => $file->getSize(),
            "mime" => $file->getClientMediaType()
        ];
    }
}
