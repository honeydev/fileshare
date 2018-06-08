<?php

namespace Fileshare\Db\factories;

use Faker\Generator as Faker;
use \Fileshare\Models\User;
use \Fileshare\Models\UserSettings;
use \Fileshare\Models\UserInfo;

class UserFactory
{
    private static $faker;

    public static function createRegularUser(): User
    {
        self::$faker = \Faker\Factory::create();
        $user = User::create([
            "email" => self::$faker->email,
            "password" => password_hash('password', PASSWORD_DEFAULT)
        ]);
        self::addUserInfo($user);
        self::addUserSettings($user);
        return $user;
    }

    private static function addUserInfo($user)
    {
        $userInfo = UserInfo::create([
            'name' => self::$faker->name,
            'avatarUri' => self::$faker->url,
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
