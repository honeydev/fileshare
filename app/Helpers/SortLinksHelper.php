<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class SortLinksHelper
{
    public static function getLinks($cursor): array
    {
        return [
            'late_to_early' => "/late_to_early/{$cursor}",
            'early_to_late' => "/early_to_late/{$cursor}"
        ];
    }
}
