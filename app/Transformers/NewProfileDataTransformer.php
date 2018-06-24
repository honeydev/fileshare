<?php

declare(strict_types=1);

namespace Fileshare\Transformers;

use Fileshare\Models\User;
use \Codeception\Util\Debug as debug;
use Funct\Collection;
use Ds\Pair;

class NewProfileDataTransformer implements TransformerInterface
{
    /**
     * @param array
     */
    public static function transform($newUserData)
    {
        $newUserData = self::filterUnnecessaryKeys($newUserData);
        $newUserData = self::fixKeyNames($newUserData);
        $newUserData = self::sortNewUserDataByModelNames($newUserData);
        return $newUserData;
    }
    
    private static function filterUnnecessaryKeys(array $newUserData): array
    {
        $NECCESSARY_KEYS = ["email", "newPassword", "name", "accountStatus", "accessLvl"];
        $keys = array_keys($newUserData);
        return array_reduce($keys, function ($acc, $currentKey) use ($newUserData, $NECCESSARY_KEYS) {
            if (in_array($currentKey, $NECCESSARY_KEYS)) {
                $acc[$currentKey] = $newUserData[$currentKey];
            }
            return $acc;
        }, []);
    }

    private static function fixKeyNames(array $newUserData): array
    {
        $keys = array_keys($newUserData);
        $keysFixMap = [
            "newPassword" => "password"
        ];
        $newKeys = Collection\Invoke($keys, function ($key) use ($keysFixMap) {
            if (array_key_exists($key, $keysFixMap)) {
                return $keysFixMap[$key];
            }
            return $key;
        });
        return array_combine($newKeys, array_values($newUserData));
    }

    private static function sortNewUserDataByModelNames(array $newUserData): array
    {
        $tableFieldsMap = [
            "email" => "user",
            "password" => "user",
            "name" => "userInfo",
            "accountStatus" => "userSettings",
            "accessLvl" => "userSettings"
        ];
        $sortedNewUserData = ["user" => [], "userInfo" => [], "userSettings" => []];

        foreach ($newUserData as $fieldName => $fieldValue) {
            $modelName = $tableFieldsMap[$fieldName];
            $sortedNewUserData[$modelName][] = new Pair($fieldName, $fieldValue);
        }

        return $sortedNewUserData;
    }
}
