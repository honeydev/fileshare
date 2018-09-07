<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class FilesSortHelper
{
    public static function earlyToLateSort(array $files): array
    {
        uasort($files, function ($file1, $file2) {
            $file1Created = $file1['created_at']->timestamp;
            $file2Created = $file2['created_at']->timestamp;
            if ($file1Created === $file2Created) {
                return 0;
            }
            return ($file1Created > $file2Created) ? -1 : 1;
        });
        return $files;
    }
}