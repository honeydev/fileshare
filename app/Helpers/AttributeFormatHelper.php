<?php

declare(strict_types=1);

namespace Fileshare\Helpers;

class AttributeFormatHelper
{
    public static function joinAttributes(array $attributes): string
    {
        $attributeNames = array_keys($attributes);
        $stringifyAttributes = "";
        foreach ($attributeNames as $attributeName) {
            $stringifyAttributes .= " {$attributeName}=\"{$attributes[$attributeName]}\" ";
        }
        return $stringifyAttributes;
    }
}
