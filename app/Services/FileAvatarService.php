<?php

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Models\File;
use Fileshare\TemplateFormaters\ImagePreviewTemplateFormater as ImagePvFormater;

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
            $url = $this->hostName . "/file/get/{$file->name}";
            return [
                'type' => 'supported', 
                'url' => $url,
                'html' => ImagePvFormater::format(
                    [
                        'src' => $url,
                        'class' => 'fileImageSupported'
                    ]
                )
            ];
        } else {
            $url = $this->prepareDefaultPreview($file->mime);
            return [
                'type' => 'default', 
                'url' => $url,
                'html' => ImagePvFormater::format(
                    [
                        'src' => $url,
                        'class' => 'fileImageDefault'
                    ]
                )
            ];
        }
    }

    private function filePreviewIsSupported(string $mime): bool
    {
        return in_array($mime, $this->previewsSupportMap['supported']);
    }


    private function prepareDefaultPreview(string $mime): string
    {
        if (array_key_exists($mime, $this->previewsSupportMap['default'])) {
            return $this->hostName . $this->previewsSupportMap['default'][$mime];
        } else {
            return $this->hostName . $this->previewsSupportMap['default']['unknown'];
        }
    }
}
