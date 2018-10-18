<?php

namespace Fileshare\Db\factories;

use Faker\Generator as Faker;
use \Fileshare\Models\{User, File};
use Fileshare\Helpers\FileNameHelper;
use \Faker\Provider\File as FileProvider;
use Fileshare\Facades\AppFacade;


class FileFactory
{
    public static function createFile(User $owner): File
    {
        $app = AppFacade::get();
        $container = $app->getContainer();
        $appFolder = $container->get('settings')['appFolder'];
        $tempFolder = sys_get_temp_dir();
        $seporator = DIRECTORY_SEPARATOR;
        $uri = FileProvider::file("{$appFolder}{$seporator}{$seporator}tests{$seporator}_data{$seporator}images", $tempFolder, true);
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
