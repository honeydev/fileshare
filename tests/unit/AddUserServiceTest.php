<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;

class AddUserServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $addUserService;

    protected function _before()
    {
        parent::__construct();
        $this->container = Fixtures::get('container');
        $this->addUserService = $this->container->get('AddUserService');
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->addUsers();
    }

    private function addUsers()
    {
        define('USERS_DATA', [
            [
            "email" => "email@email.com", 
            "password" => "mypassword",
            "name" => "my name",
            "accessLvl" => 1
            ]
        ]);

        $this->tester->assertNull($this->addUserService->addUser(USERS_DATA[0]));
    }
}
