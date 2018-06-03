<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;
use \Fileshare\Models\User;
use \Fileshare\Models\UserSettings;

class ACLTest extends \FileshareTests\unit\AbstractTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $container;
    private $acl;

    protected function _before()
    {
        $this->acl = $this->container->get('ACL');
    }

    protected function _after()
    {
    }

    public function testGetPermission()
    {
        $user = $this->provideUser();
        debug::debug($user);
    }

    private function provideUser(): User
    {
        $faker = \Faker\Factory::create();
        $user = User::create([
            "email" => $faker->email,
            "password" => password_hash($faker->password, PASSWORD_DEFAULT)
        ]);
        
        $userSettings = UserSettings::create([
            "accessLvl" => 1,
            "accountStatus" => 1,
            "userId" => $user->id

        ]);
        $user->userSettings()->save($userSettings);
        
       return $user;
    }
}
