<?php

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Models\File;

class FileAvatarService
{
    /**
     * @property {string} host url
     */
    private $hostName;
    /**
     * @property [array]
     */
    private $previewsSupportMap;

    public function __construct($container)
    {
        $this->hostName = $container->get('settings')['appInfo']['hostname'];
        $this->previewsSupportMap = $container->get('settings')['previewsMap'];
    }

    public function getAvatar(File $file): array
    {
        if ($this->filePreviewIsSupported($file->mime)) {
            return [
                'type' => 'supported', 
                'url' => $this->hostName . "/file/get/{$file->name}"
            ];
        } else {
            return [
                'type' => 'default', 
                'url' => $this->getDefaultPreview($file->mime)
            ];
        }
    }

    private function filePreviewIsSupported(string $mime): bool
    {
        return in_array($mime, $this->previewsSupportMap['supported']);
    }

    private function getDefaultPreview(string $mime): string
    {
        if (array_key_exists($mime, $this->previewsSupportMap['default'])) {
            return $this->hostName . $this->previewsSupportMap['default'][$mime];
        } else {
            return $this->hostName . $this->previewsSupportMap['default']['unknown'];
        }
    }
}
