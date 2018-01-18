<?php

namespace FileshareTests\unit;

use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class OwnerMiddlewareTest extends \Codeception\Test\Unit
{
    use \FileshareTests\unit\traits\CreateUserSessionTrait;
    use \FileshareTests\unit\traits\CreateRequestTrait;
    use \FileshareTests\unit\traits\CreateResponseTrait;
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $container;
    /**
     * @property \Fileshare\Models\SessionModel
     */
    private $sessionModel;
    /**
     * @property \Psr\Http\Message\ServerRequestInterface
     */
    private $request;
    /**
     * @property \Psr\Http\Message\ResponseInterface
     */
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
        $this->testWithRegularUser();
    }

    private function testWithRegularUser()
    {
        $this->createRegularUserEnv();
        $this->tester->assertInstanceOf(
            '\Psr\Http\Message\ResponseInterface',
            (new \Fileshare\Middlewares\OwnerMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                return $response;
            })
        );
    }

    private function createRegularUserEnv()
    {
        $this->sessionModel = $this->createRegularUserSession($this->container);
        $this->request = $this->createRequest($this->container, array('id' => '7'));
        $this->response = $this->createResponse($this->container);
    }
}
