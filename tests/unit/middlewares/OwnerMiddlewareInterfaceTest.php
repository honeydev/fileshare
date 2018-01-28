<?php

namespace FielshareTests\unit\middleware;

use \Codeception\Util\Debug as debug;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class OwnerMiddlewareInterfaceTest extends \FileshareTests\unit\AbstractTest
{
    use \FileshareTests\unit\traits\CreateFakeUserTrait;
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
    /** @property string */
    private $correctUserId;
    /** @property string */
    private $incorrectUserId;

    public function __construct()
    {
        parent::__construct();
    }

    protected function _before()
    {
        $this->correctUserId = $this->createUser([
            'users' => ['email' => 'testuser@test.com', 'hash' => 'fakehash']
        ]);
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
        $this->createRegularUserEnv(array('id' => $this->correctUserId));
        $this->tester->assertInstanceOf(
            '\Psr\Http\Message\ResponseInterface',
            (new \Fileshare\Middlewares\OwnerMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                return $response;
            }, 'must return response without exceptions')
        );
    }

    private function testWithNotOwnerRegularUser()
    {
        $this->createRegularUserEnv(array('id' => 'not_existed_id'));
        (new \Fileshare\Middlewares\OwnerMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
             return $response;
        });
        $this->tester->seeFileFound($this->logsDir . 'notices.log');
        $this->tester->openFile($this->logsDir . 'notices.log');
        $this->tester->seeInThisFile('Failed attempt check owner with idnot_existed_idby user testuesr@test.com  with id');
    }

    private function testWithAdminUser()
    {
        $this->createAdminUserEnv(array('id' => 'not_existed_id'));
        $this->tester->assertInstanceOf(
            '\Psr\Http\Message\ResponseInterface',
            (new \Fileshare\Middlewares\OwnerMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                return $response;
            }, 'admin not profile owner, but he has rights change all users profile')
        );
    }
}
