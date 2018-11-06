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
        $separator = DIRECTORY_SEPARATOR;
        $sourceDir = "{$appFolder}{$separator}tests{$separator}_data{$separator}images";
        $targetDir = "storage{$separator}uploads/{$owner->email}";
        if (!file_exists($targetDir)) {
            mkdir($targetDir);
        }
        $uri = FileProvider::file($sourceDir, $targetDir, true);
        $name = md5((String) mt_rand()) . "_" . FileNameHelper::getFileNameByUri($uri);
        copy($uri, "{$targetDir}/{$name}");
        $file = File::create([
            'name' => $name,
            'uri' => $uri,
            'mime' => mime_content_type($uri),
            'size' => filesize($uri),
            'ownerId' => $owner->id
        ]);
        $file->save();
        return $file;
    }
}
