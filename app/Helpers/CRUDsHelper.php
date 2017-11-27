<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class CRUDsHelper
{
    public function getKeysSection(array $assocArray)
    {
        return '(' . implode(', ', array_keys($assocArray)) . ')';
    }

    public function getValuesSection(array $assocArray)
    {
        return '(' . implode(', ', array_values($assocArray)) . ')';
    }
}
