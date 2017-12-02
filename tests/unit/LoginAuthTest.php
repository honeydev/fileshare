<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;

class LoginAuthTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $container;
    private $loginAuth;
    const FAKE_USERS = [
        ['email' => 'fake1@email.com', 'password' => 'fakePassword1'],
        ['email' => 'fake2@email.com', 'password' => 'fakePassword2'],
        ['email' => 'fake3@email.com', 'password' => 'fakePassword3']
    ];

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
        $this->requireUserDataWithIncorrectColumnName();
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
            $this->tester->assertTrue($this->loginAuth->auth($fakeUser));
        }
    }

    private function requireUserDataWithIncorrectColumnName()
    {
        $this->tester->expectException('\PDOException', function () {
            $this->tester->haveInDatabase('users', [
                'emailL' => 'email@email.com',
                'hash' => 'fakeHash'
            ]);
        });
    }

    private function userNotExist()
    {
        $this->tester->expectException('Fileshare\Exceptions\AuthorizeException', function () {
            $this->loginAuth->auth(['email' => 'notExistsEmail@email.com', 'password' => 'fakePsw']);
        });
    }
}