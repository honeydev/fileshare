<?php

declare(strict_types=1);

namespace Fileshare\Transformers;

use Fileshare\Models\User;
use \Codeception\Util\Debug as debug;

class NewProfileDataTransformer implements TransformerInterface
{
    public static function transform($newUserData): array
    {
        $newUserData = self::filterUnnecessaryKeys($newUserData);
    }

    private static function filterUnnecessaryKeys(array $newUserData): array
    {
        $necessaryKeys = ["email", "newPassword", "name"];
        $keys = array_keys($newUserData);
        return array_reduce($keys, function ($acc, $currentKey) use ($newUserData, $necessaryKeys) {
            if (in_array($currentKey, $necessaryKeys)) {
                $acc[$currentKey] = $newUserData[$currentKey];
            }
            return $acc;
        }, []);
    }

    private static function sortNewUserDataByCategories(array $newUserData)
    {
        //implement sort
    }
}
