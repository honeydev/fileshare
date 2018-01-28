<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;

class AddUserServiceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $container;

    private $addUserService;

    protected function _before()
    {
        $this->container = Fixtures::get('container');
        $this->addUserService = $this->container->get('AddUserService');
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->addCorrectUsers();
    }

    private function addCorrectUsers()
    {
        define("CORRECT_USERS", [
            ['email' => 'mailmail1@email.com', 'password' => 'password1', 'accessLvl' => '1'],
            ['email' => 'mailmail2@email.com', 'password' => 'password2', 'accessLvl' => '1'],
            ['email' => 'mailmail3@email.com', 'password' => 'password4', 'accessLvl' => '1']
        ]);

        foreach (CORRECT_USERS as $correctUser) {
            $this->addUserService->addUser($correctUser);
            $this->tester->seeInDatabase('users', [
                'email' => $correctUser['email']
            ]);
            $hash = $this->tester->grabFromDatabase('users', 'hash', ['email' => $correctUser['email']]);
            $this->tester->assertTrue(password_verify($correctUser['password'], $hash));
        }
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
