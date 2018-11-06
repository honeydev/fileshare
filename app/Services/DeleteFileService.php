<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Fileshare\Models\File;
use \Fileshare\Exceptions\IOException;
use \Codeception\Util\Debug as debug;
use Fileshare\Models\FileInterface;

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
     * @param FileInterface
     * @throws IOException
     */
    public function delete(FileInterface $file)
    {
        $fileUri = "{$this->appFolder}/{$file->uri}";
        if (!unlink($fileUri)) {
            throw new IOException("Cant't remove file {$fileUri} from disk");
        }
    }
}
