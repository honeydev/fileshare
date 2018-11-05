<?php

declare(strict_types=1);

namespace Fileshare\Transformers;

use Fileshare\Models\User;
use Fileshare\Facades\AppFacade;

class UserTransformer implements TransformerInterface
{
    public static function transform($user): array
    {
        return self::transformUserObjectToData($user);
    }

    private static function transformUserObjectToData(User $user): array
    {
        $container = (AppFacade::get())->getContainer();
        $hostUrl = $container->get('settings')['appInfo']['hostname'];
        $userData = [
            "id" => (int) $user->id,
            "email" => $user->email,
            "token" => $user->token,
        ];

        if (!empty($user->userInfo)) {
            $userData['name'] = $user->userInfo->name;
            $userData['avatarUri'] = $hostUrl . $user->avatar()->uri;
        }

        if (!empty($user->userSettings)) {
            $userData['accountStatus'] = $user->userSettings->accountStatus;
            $userData['accessLvl'] = $user->userSettings->accessLvl;
        }

        return $userData;
    }
}