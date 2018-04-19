<?php

declare(strict_types=1);

namespace Fileshare\Transformers;

use Fileshare\Models\User;

class UserTransformer implements TransformerInterface
{
    public static function transform(User $user): array
    {
        return self::transformUserObjectToData($user);
    }

    private static function transformUserObjectToData(User $user): array
    {
        return [
            "id" => (int) $user->id,
            "email" => $user->email,
            "token" => $user->token,
            "name" => $user->name,
            "avatarUri" => $user->$avatarUri,
            "accountStatus" => $user->accountStatus,
            "accessLvl" => $user->accessLvl
        ];
    }
}