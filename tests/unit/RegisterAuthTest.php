<?php


class RegisterAuthTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $db;

    public function __construct()
    {
        parent::__construct();

    }

    protected function _before()
    {
        var_dump($GLOBALS);
        $this->addFaketUsers();
    }

    protected function _after()
    {
    }

    private function addFaketUsers()
    {
        define('FAKE_USERS', [
            ['email' => 'fakeuser1@mail.ru', 'hash' => 'fakeUser'],
            ['email' => 'fakeuser2@mail.ru', 'hash' => 'fakeUser'],
            ['email' => 'fakeuser3@mail.ru', 'hash' => 'fakeUser'],
        ]);
        $this->tester->haveInDatabase('users', ['email' => 'fakeuser1@mail.ru', 'hash' => 'fakeUser']);
    }
    // tests
    public function testSomeFeature()
    {
        $this->tester->seeInDatabase('users', ['email' => 'fakeuser1@mail.ru', 'hash' => 'fakeUser']);
    }

    private function addNotExistedUser()
    {

    }

    private function addUserWithEmailEqualExistedUser()
    {

    }
}