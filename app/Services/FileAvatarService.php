<?php

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Models\File;

class FileAvatarService
{
    /**
     * @property {string} host url
     */
    private $host;

    public function __construct($container)
    {
        $this->host = $container->get('settings')['appInfo']['hostname'];
    }

    public function getFileTypeImageUriByMime(File $file): string
    {
        if (false) {
            //todo implement 
        } else {
            return "{$this->host}/img/file.svg";
        }
    }
}
