<?php
/**
 * @class FileTypeMiddleware
 */

declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Codeception\Util\Debug as debug;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class FileTypeMiddleware extends AbstractMiddleware
{
    const FILE_TYPES = array(
        'images' => ['image/jpeg', 'image/png', 'image/gif', 'image/bmp'],
        'videos' => [
            "video/mpeg", "video/avi", "video/wmv", "video/quicktime", "video/x-matroska", "3video/3gpp2",
            "video/x-flv"
        ],
        'audio' => ['audio/mpeg3', 'audio/wav', 'audio/aac', 'audio/ogg'],
        'archive' => [
            'application/x-7z-compressed', 'application/gzip', 'application/x-tar', 'application/tar',
            'application/tar+gzip', 'application/x-rar-compressed', 'pplication/x-cbr'
        ]
    );

    public function __invoke(Request $request, Response $response, $next)
    {
        $uploadedFiles = $request->getUploadedFiles()['file']K;
        $request = $request->withAttribute('fileType', $this->detectFileType($uploadedFile));
        $response = $next($request, $response);
        return $response;
    }

    private function detectFileType(\Slim\Http\UploadedFile $uploadedFile): string {
        define('MIME_TYPE', $uploadedFile->getClientMediaType());
        foreach (self::FILE_TYPES as $fileType => $mimeTypes) {
            if (in_array(MIME_TYPE, $mimeTypes)) {
                return $fileType;
            }
        }
        return 'unknown';
    }
}
