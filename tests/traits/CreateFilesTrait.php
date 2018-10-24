<?php

declare(strict_types=1);

namespace FileshareTests\traits;

use \Fileshare\Db\factories\FileFactory;
use \Fileshare\Models\User;

trait CreateFilesTrait
{
    protected function createFilesAnonymous(int $filesCount): array
    {
        $files = [];

        for ($i = 0; $i < $filesCount; $i++) {
            $file = FileFactory::createFile(User::getUserByEmail('anonymous@fileshare'));
            $files[] = $file;
        }

        return $files;
    }
}
