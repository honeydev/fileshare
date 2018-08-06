<?php

declare(strict_types=1);

namespace Fileshare\Transformers;

use Fileshare\Models\User;

class UserTransformer implements TransformerInterface
{
    public static function transform($user): array
    {
        return self::transformUserObjectToData($user);
    }

    private static function transformUserObjectToData(User $user): array
    {
        $userData = [
            "id" => (int) $user->id,
            "email" => $user->email,
            "token" => $user->token,
            "name" => $user->userInfo->name,
            "accountStatus" => $user->userSettings->accountStatus,
            "accessLvl" => $user->userSettings->accessLvl
        ];

        if (empty($user->avatar)) {
            $userData['avatarUri'] = null;
        } else {
            $userData['avatarUri'] = $user->avatar->file->uri;
        }

        return $userData;
    }
}