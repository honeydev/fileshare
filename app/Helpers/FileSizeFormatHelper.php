<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class FileSizeFormatHelper
{
    public static function bytesToMbytes(int $bytes): string
    {
        if (is_float($megabytes = $bytes * 0.000001)) {
            $megabytes = round($megabytes, 3);
        } else {
            $megabytes = $megabytes;
        }
        return (string) $megabytes;
    }
}