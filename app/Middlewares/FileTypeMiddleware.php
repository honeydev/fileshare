<?php
/**
 * @class FileTypeMiddleware
 */

declare(strict_types=1);

namespace Fileshare\Middlewares;


class FileTypeMiddleware extends AbstractMiddleware
{
    const FILE_TYPES = array(
        'images' => ['image/jpeg', 'image/jpeg', 'image/png', 'image/gif', 'image/bmp'],
        'videos' => [
            "video/mpeg", "video/avi", "video/wmv", "video/quicktime", "video/x-matroska", "3video/3gpp2",
            "video/x-flv"
        ],
        'audio' => ['audio/mpeg3', 'audio/wav', 'audio/aac', 'audio/ogg'],
        'archive' => [
            'application/x-7z-compressed', 'application/gzip', '	application/x-tar', 'application/tar',
            'application/tar+gzip', 'application/x-rar-compressed', 'cbr'
        ]
    );
}
