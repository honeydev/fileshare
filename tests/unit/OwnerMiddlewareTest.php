<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;

class OwnerMiddlewareTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $container;
    private $ownerMiddleware;
    private $sessionModel;
    private $request;
    private $response;

    public function __construct()
    {
        parent::__construct();
        $this->container = Fixtures::get('container');
    }

    protected function _before()
    {
        $this->createRegularUserEnv();
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->createRegularUserEnv();
        $this->testWithRegularUser();
    }

    private function testWithRegularUser()
    {
        Debug::debug($this->ownerMiddleware);
        (new \Fileshare\Middlewares\OwnerMiddleware($this->container))($this->request, $this->response, null);
    }

    private function createRegularUserEnv()
    {
        $this->createRegularUserSession();
        $this->createRequestWithUserId('7');
        $this->createResponse();
    }

    private function createRegularUserSession()
    {
        $this->sessionModel = $this->container->get('SessionModel');
        $this->sessionModel->authorizeStatus = true;
        $this->sessionModel->accessLvl = 1;
        $this->sessionModel->ip = '192.168.54.2';
        $this->sessionModel->user = $this->container->get('RegularUserModel');
        $this->sessionModel->user->email = 'testuesr@test.com';
        $this->sessionModel->user->name = 'Test user';
        $this->sessionModel->user->id = '7';
    }

    private function createRequestWithUserId(string $id)
    {
        $this->request = $this->container->get('request');
        $this->request->withParsedBody(array(
            'id' => $id
            ));
    }

    private function createResponse()
    {
        $this->response = $this->container->get('response');
    }
}