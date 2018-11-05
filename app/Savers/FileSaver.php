<?php

declare(strict_types=1);

namespace Fileshare\Savers;

use Fileshare\Models\FileInterface;
use Fileshare\Exceptions\IOException;
use \Slim\Http\UploadedFile;
use \Fileshare\Models\File;
use \Fileshare\Models\FileToken;

class FileSaver implements SaversInterface
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
    /**
     * @param UploadedFile $file
     * @param array $params
     * @throws IOException
     * @return File
     */
    public function save(UploadedFile $file, array $params): FileInterface
    {
        $fileAttributes = $this->uploadsMovementService->movment($file, $params);
        $fileAttributes['ownerId'] = $params['owner']->id;
        $file = new File($fileAttributes);
        $file->save();
        return $file;
    }
}
