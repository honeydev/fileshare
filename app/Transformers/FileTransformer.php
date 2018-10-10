<?php

declare(strict_types=1);

namespace Fileshare\Transformers;

use Fileshare\Models\User;
use Fileshare\Facades\AppFacade;
use \Fileshare\Helpers\{FileSizeFormatHelper, FileNameHelper};
/**
 * @class FileTransformer transform file model for view
 */
class FileTransformer implements TransformerInterface
{
    /**
     * @param  [\Fileshare\Models\File] $file [description]
     * @return [array]       [transformed file data]
     */
    public static function transform($file): array
    {
        $container = (AppFacade::get())->getContainer();
        $hostUrl = $container->get('settings')['appInfo']['hostname'];
        $fileAvatarService = $container->get("FileAvatarService");
        $fileArray = [];
        if (!empty($file->size)) {
            $fileArray['size'] = FileSizeFormatHelper::bytesToMbytes((int) $file->size);
        }

        if (!empty($file->name)) {
            $fileArray['name'] = FileNameHelper::sliceFileNameUniqueCode($file->name);
        }

        if (!empty($file->uri)) {
            $fileArray['url'] = "{$hostUrl}/file/get/{$file->name}";
            $fileArray['filePageUrl'] = "{$hostUrl}/file/{$file->name}";
        }

        if (!empty($file->mime)) {
            $fileArray['mime'] = $file->mime;
            $fileArray['fileAvatar'] = $fileAvatarService->getAvatar($file);
        }

        if (!empty($file->created_at)) {
            $fileArray['created'] = $file->created_at->format('d M Y H:i:s');
        }

        return $fileArray;
    }
}
