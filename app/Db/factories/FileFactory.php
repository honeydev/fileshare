<?php

namespace Fileshare\Db\factories;

use Faker\Generator as Faker;
use \Fileshare\Models\{User, File};
use Fileshare\Helpers\FileNameHelper;
use \Faker\Provider\File as FileProvider;


class FileFactory
{
    public static function createFile(User $owner): File
    {
        $uri = FileProvider::file('/var/www/fileshare/tests/_data/images', '/tmp', true);
        $file = File::create([
            'name' => md5((String) mt_rand()) . "_" . FileNameHelper::getFileNameByUri($uri),
            'uri' => $uri,
            'mime' => mime_content_type($uri),
            'size' => filesize($uri),
            'ownerId' => $owner->id
        ]);
        $file->save();
        return $file;
    }
}
