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
     * @property \Fileshare\Services\UploadsMovementService
     */
    private $uploadsMovementService;

    public function __construct($container)
    {
        $this->uploadsMovementService = $container->get('UploadsMovementService');
        $this->storageDir = $container->get('settings')['appFolder'] . "/storage";
    }

    public function save(UploadedFile $file, array $params): File
    {
        $fileAttributes = $this->uploadsMovementService->movment($file, $params);
        $fileAttributes['ownerId'] = $params['owner']->id;
        $file = new File($fileAttributes);
        $file->save();
        return $file;
    }
}
