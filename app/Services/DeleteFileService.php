<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Fileshare\Models\File;
use \Fileshare\Exceptions\IOException;
use \Codeception\Util\Debug as debug;

class DeleteFileService
{
    /**
     * @throws IOException
     */
    public function delete(File $file)
    {
        $fileUri = $file->uri;
        if (!unlink($fileUri)) {
            throw new IOException("Cant't remove {$fileUri} from disk");
        }
    }
}
