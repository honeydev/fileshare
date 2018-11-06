<?php

declare(strict_types=1);

namespace FileshareTests\traits;

use \Fileshare\Db\factories\FileFactory;
use \Fileshare\Models\User;

trait CreateFilesTrait
{
    protected function createFilesAnonymous(int $filesCount, $sleep = 0): array
    {
        $files = [];

        for ($i = 0; $i < $filesCount; $i++) {
            sleep($sleep);
            $file = FileFactory::createFile(User::getUserByEmail('anonymous@fileshare'));
            $files[] = $file;
        }
        return $files;
    }

    protected function createFilesByUser(User $user, int $filesCount, $sleep = 0): array
    {
        $files = [];

        for ($i = 0; $i < $filesCount; $i++) {
            sleep($sleep);
            $file = FileFactory::createFile($user);
            $files[] = $file;
        }
        return $files;
    }
}
