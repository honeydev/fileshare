<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Phinx\Seed\AbstractSeed;
use Illuminate\Database\Capsule\Manager as Capsule;
use Fileshare\Models\User;
use Fileshare\Models\UserInfo;
use Fileshare\Models\UserSettings;

class Annonymous extends AbstractSeed
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
        $user = new User(['email' => 'annonymous@fileshare', 'password' => uniqid()]);
        $user->save();
        $userInfo = new UserInfo([
            'name' => 'annonym',
            'avatarUri' => '/img/user.png'
        ]);
        $user->userInfo()->save($userInfo);
        $userSettings = new UserSettings([
            'accountStatus' => 1,
            'accessLvl' => 1
        ]);
        $user->userSettings()->save($userSettings);
    }
}