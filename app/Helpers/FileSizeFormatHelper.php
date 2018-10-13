<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class FileSizeFormatHelper
{
    public static function bytesToMbytes(int $bytes)
    {
        var_dump($bytes);
        if (is_float($megabytes = $bytes * 0.000001)) {
            return round($megabytes, 3);
        } else {
            return $megabytes;
        }
    }
}