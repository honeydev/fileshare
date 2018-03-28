<?php

declare(strict_types=1);

namespace Fileshare\Transformers;

use Nayjest\StrCaseConverter\Str;

class CamelCaseKeyTransformer implements TransformerInterface
{
    /**
     * @param {array} $underscoreKeysArray
     * @return {array}
     */
    public static function transform($underscoreKeysArray)
    {
        return self::transformArrayKeysToCamelCase($underscoreKeysArray);
    }

    private static function transformArrayKeysToCamelCase(array $underscoreKeysArray): array
    {
        $result = [];
        array_map(function ($key, $value) use (&$result) {
            $newKey = lcfirst(Str::toCamelCase($key));
            $result[$newKey] = $value;
        }, array_keys($underscoreKeysArray), $underscoreKeysArray);
        return $result;
    }
}
