<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;

class RegisterAuthTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $db;
    private $registerAuth;
    const FAKE_USERS = [
        ['email' => 'fakeuser1@mail.ru', 'hash' => 'fakeUser'],
        ['email' => 'fakeuser2@mail.ru', 'hash' => 'fakeUser'],
        ['email' => 'fakeuser3@mail.ru', 'hash' => 'fakeUser'],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->container = Fixtures::get('container');
        $this->registerAuth = $this->container->get('RegisterAuth');
    }

    protected function _before()
    {
        $this->addFakeUsers();
    }

    protected function _after()
    {
    }

    private function addFakeUsers()
    {
        foreach (self::FAKE_USERS as $fakeUser) {
            $this->tester->haveInDatabase('users', $fakeUser);
        }
    }
    // tests
    public function testSomeFeature()
    {
        $this->addNotExistedUser();
        $this->addUserWithEmailEqualExistedUser();
    }

    private function addNotExistedUser()
    {
        $this->tester->assertTrue($this->registerAuth->auth(['email' => 'free@email.com', 'hash' => 'justFakeHash']));
    }

    private function addUserWithEmailEqualExistedUser()
    {
        foreach (self::FAKE_USERS as $fakeUser) {
            $this->tester->expectException('Fileshare\Exceptions\AuthorizeException', function () use ($fakeUser) {
                $this->registerAuth->auth(['email' => $fakeUser['email'], 'hash' => $fakeUser['hash']]);
            });
        }
    }
}