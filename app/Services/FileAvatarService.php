<?php

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Models\File;
use Fileshare\TagFormaters\AbstractTagFormater;
use Fileshare\Helpers\StringFormatHelper;

class FileAvatarService
{
    /**
     * @property string
     */
    private $type;
    /**
     * @property string
     */
    private $group;
    /**
     * @property string
     */
    private $url;
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
        $this->defineAvatarProperties($file);
        return [
            'type' => $this->type,
            'group' => $this->group,
            'url' => $this->url,
            'tag' => $this->prepareTagData($file->mime, ["src" => $this->url])
        ];
    }

    private function defineAvatarProperties(File $file)
    {
        if ($this->filePreviewIsSupported($file->mime)) {
            $this->group = 'supported';
            $this->url = $this->prepareSupportedAvatarUrl($file->name);
        } else {
            $this->group = 'default';
            $this->url = $this->prepareDefaultAvatarUrl($file->mime);
        }
        $this->type = StringFormatHelper::transformMimeToFileType($file->mime);
    }

    private function filePreviewIsSupported(string $mime): bool
    {
        return in_array($mime, $this->previewsSupportMap['supported']);
    }

    private function prepareSupportedAvatarUrl(string $fileName): string
    {
        return $this->hostName . "/file/get/{$fileName}";
    }

    private function prepareDefaultAvatarUrl(string $mime): string
    {
        if (array_key_exists($mime, $this->previewsSupportMap['default'])) {
            return $this->hostName . $this->previewsSupportMap['default'][$mime];
        }
        return $this->hostName . $this->previewsSupportMap['default']['unknown'];
    }

    private function prepareTagData(string $mime, array $attributes): array
    {
        $tagFormater = AbstractTagFormater::create($mime);
        return $tagFormater->format($attributes);
    }
}
