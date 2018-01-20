<?php

namespace FielshareTests\unit\middleware;

use \Codeception\Util\Debug as debug;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class OwnerMiddlewareInterfaceTest extends \FileshareTests\unit\AbstractTest
{
    /** @property string */
    const CORRECT_TEST_USER_ID = '7';
    /** @property string */
    const INCORRECT_TEST_USER_ID = '4';
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @property \Fileshare\Models\SessionModel
     */
    protected $sessionModel;
    /**
     * @property \Psr\Http\Message\ServerRequestInterface
     */
    protected $request;
    /**
     * @property \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    public function __construct()
    {
        parent::__construct();
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->testWithOwnerRegularUser();
        $this->testWithNotOwnerRegularUser();
        $this->testWithAdminUser();
    }

    private function testWithOwnerRegularUser()
    {
        $this->createRegularUserEnv(array('id' => self::CORRECT_TEST_USER_ID));
        $this->tester->assertInstanceOf(
            '\Psr\Http\Message\ResponseInterface',
            (new \Fileshare\Middlewares\OwnerMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                return $response;
            }, 'must return response without exceptions')
        );
    }

    private function testWithNotOwnerRegularUser()
    {
        $this->createRegularUserEnv(array('id' => self::INCORRECT_TEST_USER_ID));
        $this->tester->expectException('\Fileshare\Exceptions\AccessException', function () {
            (new \Fileshare\Middlewares\OwnerMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                return $response;
            });
        });
    }

    private function testWithAdminUser()
    {
        $this->createAdminUserEnv(array('id' => self::INCORRECT_TEST_USER_ID));
        $this->tester->assertInstanceOf(
            '\Psr\Http\Message\ResponseInterface',
            (new \Fileshare\Middlewares\OwnerMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                return $response;
            }, 'admin not profile owner, but he has rights change all users profile')
        );   
    }
}