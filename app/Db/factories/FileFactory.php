<?php

namespace Fileshare\Db\factories;

use Faker\Generator as Faker;
use \Fileshare\Models\{User, File};
use \Faker\Provider\File as FileProvider;

class FileFactory
{
    public static function createFile(User $owner): File
    {
        $fileName = FileProvider::file('/home', '/tmp', true);
        $file = File::create([
            'name' => $fileName,
            'uri' => $fileName,
            'mime' => mime_content_type($fileName),
            'size' => filesize($fileName),
            'ownerId' => $owner->id
        ]);
        $file->save();
        return $file;
    }
}
