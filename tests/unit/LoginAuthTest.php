<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;

class LoginAuthTest extends \Codeception\Test\Unit
{
    const FAKE_USERS = [
        ['email' => 'fake1@email.com', 'password' => 'fakePassword1'],
        ['email' => 'fake2@email.com', 'password' => 'fakePassword2'],
        ['email' => 'fake3@email.com', 'password' => 'fakePassword3']
    ];
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $container;
    private $loginAuth;

    protected function _before()
    {
        $this->container = Fixtures::get('container');
        $this->loginAuth = $this->container->get('LoginAuth');
        $this->addFakeUsersInBase();
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->loginCorrectUsers();
        $this->userNotExist();
    }

    private function addFakeUsersInBase()
    {
        foreach (self::FAKE_USERS as $fakeUser) {
            $this->tester->haveInDatabase('users', [
                    'email' => $fakeUser['email'],
                    'hash' => password_hash($fakeUser['password'], PASSWORD_DEFAULT)
                ]
            );
        }
    }

    private function loginCorrectUsers()
    {
        foreach (self::FAKE_USERS as $fakeUser) {
            $userData = $this->loginAuth->auth($fakeUser);
            $this->tester->assertInternalType('array', $userData);
            $this->tester->assertEquals($fakeUser['email'], $userData['email']);
            $this->tester->assertTrue(password_verify($fakeUser['password'], $userData['hash']));
        }
    }

    private function userNotExist()
    {
        $this->tester->expectException('Fileshare\Exceptions\AuthorizeException', function () {
            $this->loginAuth->auth(['email' => 'notExistsEmail@email.com', 'password' => 'fakePsw']);
        });
    }
}
