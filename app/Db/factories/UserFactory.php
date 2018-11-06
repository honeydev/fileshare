<?php

namespace Fileshare\Db\factories;

use Faker\Generator as Faker;
use \Fileshare\Models\User;
use \Fileshare\Models\UserSettings;
use \Fileshare\Models\UserInfo;


class UserFactory
{
    const PASSWORD = 'password';

    private static $faker;

    public static function createRegularUser($container): User
    {
        self::$faker = \Faker\Factory::create();
        $email = self::$faker->email;
        $cryptoService = $container->get("CryptoService");
        $user = User::create([
            "email" => $email,
            "password" => password_hash(self::PASSWORD, PASSWORD_DEFAULT)
        ]);

        $jwt = $cryptoService->generateJwtToken(
            [
                "identifier" => $user->id,
                "appHost" => $container->get("settings")['appInfo']['hostname'],
                "secretKey" => $container->get("settings")['secretKey']
            ]
        );
        $user->token = $jwt;
        $user->save();
        self::addUserInfo($user);
        self::addUserSettings($user);
        $user->nCryptedPassword = self::PASSWORD;
        return $user;
    }

    private static function addUserInfo($user)
    {
        $userInfo = UserInfo::create([
            'name' => self::$faker->name,
            'userId' => $user->id
        ]);
        $user->userInfo()->save($userInfo);
    }

    private static function addUserSettings($user, $params = ['accountStatus' => 1, 'accessLvl' => 1])
    {
        $userSettings = UserSettings::create([
            'accountStatus' => $params['accountStatus'],
            'accessLvl' => $params['accessLvl'],
            'userId' => $user->id
        ]);
        $user->userSettings()->save($userSettings);
    }
}
