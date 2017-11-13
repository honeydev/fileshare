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
        define('USERS', [
            ['email' => 'fakeuser1@mail.ru', 'hash' => 'fakeUser'],
            ['email' => 'fakeuser2@mail.ru', 'hash' => 'fakeUser'],
            ['email' => 'fakeuser3@mail.ru', 'hash' => 'fakeUser']
        ]);

        foreach (USERS as $fakeUser) {
            $this->addUserInBase($fakeUser);
        }
    }

    private function addUserInBase($userData)
    {
        extract($userData);
        $query = "INSERT INTO users (email, hash, id) VALUES (:email, :hash, NULL)";
        $this->db->prepare($query);
        $query->excute(['email' => $email, 'hash' => $hash]);
    }
    // tests
    public function testSomeFeature()
    {

    }
}