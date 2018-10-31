<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class SelectHelper
{
    public static function getOffset(int $cursor, int $articlesOnPage): int
    {
        $start = $cursor - 1;
        return $start * $articlesOnPage;
    }
}
