<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

use Fileshare\Models\File;

class FilesSortHelper
{
    public static function earlyToLateSort(array $files): array
    {
        return self::sort($files, function (File $file1, File $file2) {
            return $file1->created_at->timestamp <=> $file2->created_at->timestamp;
        });
    }

    public static function lateToEarlySort(array $files): array
    {
        return self::sort($files, function (File $file1, File $file2) {
            return $file2->created_at->timestamp <=> $file1->created_at->timestamp;
        });
    }

    private static function sort(array $files, callable $sortFunction): array
    {
        $filesForSort = $files;
        usort($filesForSort, $sortFunction);
        return $filesForSort;
    }
}