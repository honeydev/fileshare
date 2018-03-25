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
        $this->addCorrectUser();
    }

    private function addCorrectUser()
    {
        $this->addUserService->addUser(['email' => 'mailmail1@email.com', 'password' => 'password1', 'accessLvl' => '1', 'name' => 'alexey']);
    }
}
