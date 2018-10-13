<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class StringFormatHelper
{
    public static function transformMimeToFileType(string $mimeType): string
    {
        $mimeTypeAsArray = explode("/", $mimeType);
        return $mimeTypeAsArray[0];
    }
}