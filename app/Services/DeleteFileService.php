<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Fileshare\Models\File;
use \Fileshare\Exceptions\IOException;
use \Codeception\Util\Debug as debug;

class DeleteFileService
{
    /**
     * @property string
     */
    private $appFolder;

    public function __construct($container)
    {
        $this->appFolder = $container->get('settings')['appFolder'];
    }
    /**
     * @throws IOException
     */
    public function delete(File $file)
    {
        $fileUri = "{$this->appFolder}/{$file->uri}";
        if (!unlink($fileUri)) {
            throw new IOException("Cant't remove file {$fileUri} from disk");
        }
    }
}
