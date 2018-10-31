<?php

declare(strict_types=1);

namespace Fileshare\Packers;

use \Fileshare\Transformers\UserTransformer;
use \Fileshare\Transformers\FileTransformer;

class FilePacker
{
    public static function pack($files): array
    {
        $filesPack = [];
        foreach ($files as $file) {
            $filesPack[] = [
                'file' => FileTransformer::transform($file),
                'owner' => UserTransformer::transform($file->owner)
            ];
        }
        return $filesPack;
    }
}
