<?php

namespace Fileshare\Db\factories;

use Faker\Generator as Faker;
use \Fileshare\Models\User;
use \Fileshare\Models\UserSettings;
use \Fileshare\Models\UserInfo;

class UserFactory
{
    public static function generate()
    {

        $faker = \Faker\Factory::create();

        $user = User::create([
            "email" => $faker->email,
            "password" => password_hash($faker->password, PASSWORD_DEFAULT)
        ]);

        $userInfo = UserInfo::create([
            'name' => $faker->name, 
            'avatarUri' => '//images//image.jpg',
            'userId' => $user->id
        ]);
        $user->userInfo()->save($userInfo);

        $userSettings = UserSettings::create([
            'accountStatus' => 1,
            'accessLvl' => 1,
            'userId' => $user->id
        ]);
        $user->userSettings()->save($userSettings);

        return $user;
    }
}
