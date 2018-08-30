<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class FileSizeFormatHelper
{
    public static function bytesToMbytes(int $bytes)
    {
        if (is_float($megabytes = $bytes / 1000000)) {
            return round($megabytes, 2);
        } else {
            return $megabytes;
        }
    }
}