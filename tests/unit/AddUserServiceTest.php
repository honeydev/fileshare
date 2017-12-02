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
            ['email' => 'mailmail1@email.com', 'password' => 'password1'],
            ['email' => 'mailmail2@email.com', 'password' => 'password2'],
            ['email' => 'mailmail3@email.com', 'password' => 'password4']
        ]);

        foreach (CORRECT_USERS as $correctUser) {
            $this->addUserService->addUser($correctUser);
            $this->tester->seeInDatabase('users', [
                'email' => $correctUser['email']
            ]);
            $hash = $this->tester->grabFromDatabase('users', 'hash', ['email' => $correctUser['email']]);
            $this->tester->assertTrue(password_verify($correctUser['password'], $hash));
        }
    }
}
