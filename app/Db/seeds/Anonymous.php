<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Phinx\Seed\AbstractSeed;
use Illuminate\Database\Capsule\Manager as Capsule;
use Fileshare\Models\{User, UserInfo, UserSettings, Avatar};

class Anonymous extends AbstractSeed
{
    /**
     * @var \Illuminate\Database\Schema\MySqlBuilder
     */
    protected $schema;

    protected function init()
    {
        $this->schema = (new Capsule)->schema();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User(['email' => 'anonymous@fileshare', 'password' => uniqid()]);
        $user->save();
        $userInfo = new UserInfo([
            'name' => 'anonym'
        ]);
        $user->userInfo()->save($userInfo);
        $userSettings = new UserSettings([
            'accountStatus' => 1,
            'accessLvl' => 1
        ]);
        $user->userSettings()->save($userSettings);
        $avatar = Avatar::create([
            'uri' => '/img/user.png',
            'ownerId' => $user->id,
            'name' => 'user.png',
        ]);
        $avatar->save();
    }
}