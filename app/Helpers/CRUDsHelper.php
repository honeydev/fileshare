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
        $assocArray = $this->addQuotesOnStringTypeValues($assocArray);
        return '(' . implode(', ', array_values($assocArray)) . ')';
    }

    public function addQuotesOnStringTypeValues(array $values)
    {
        return array_map(function ($value) {
            if (is_string($value)) {
                return $this->addQuotes($value);
            } else {
                return $value;
            }
        }, $values);
    }

    private function addQuotes(string $stringValue)
    {
        return '"' . $stringValue . '"';
    }
}
