<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class FileNameHelper
{
    public static function sliceFileNameUniqueCode(string $name): string
    {
        $fileNameWithoutCode = array_slice(explode('_', $name), 1);
        return implode('', $fileNameWithoutCode);
    }

    public static function getFileNameByUri(string $uri): string
    {
        $uriAsArraay = explode(DIRECTORY_SEPARATOR, $uri);
        return $uriAsArraay[count($uriAsArraay) - 1];
    }
}
