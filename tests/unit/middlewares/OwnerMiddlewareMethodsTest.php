<?php

namespace FielshareTests\unit\middleware;

use \Codeception\Util\Debug as debug;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class OwnerMiddlewareMethodsTest extends \FileshareTests\unit\AbstractTest
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
        $this->testUserIsOwner();
    }

    private function testUserIsOwner()
    {
        $this->testWithOwner();
        $this->testWithNotOwner();
    }

    private function testWithOwner()
    {
        $this->createRegularUserEnv(array('id' => self::CORRECT_TEST_USER_ID));
        $ownerMiddleware = new \Fileshare\Middlewares\OwnerMiddleware($this->container);
        $ownerMiddleware($this->request, $this->response, function ($request, $response) { return $response; });
        $ownerMiddlewareReflection = new \ReflectionClass(get_class($ownerMiddleware));
        $ownerMiddlewareUserIsOwnerMetod = $ownerMiddlewareReflection->getMethod('userIsOwner');
        $ownerMiddlewareUserIsOwnerMetod->setAccessible(true);
        $this->tester->assertTrue($ownerMiddlewareUserIsOwnerMetod->invoke($ownerMiddleware), 'must return true, because user is owner');
    }

    private function testWithNotOwner()
    {
        $this->createRegularUserEnv(array('id' => self::CORRECT_TEST_USER_ID));
        $ownerMiddleware = new \Fileshare\Middlewares\OwnerMiddleware($this->container);
        $ownerMiddleware($this->request, $this->response, function ($request, $response) { return $response; });
        $ownerMiddlewareReflection = new \ReflectionClass(get_class($ownerMiddleware));
        $ownerMiddlewareUserIsOwnerMetod = $ownerMiddlewareReflection->getMethod('userIsOwner');
        $ownerMiddlewareUserIsOwnerMetod->setAccessible(true);
        $this->tester->assertTrue($ownerMiddlewareUserIsOwnerMetod->invoke($ownerMiddleware), 'must return true, because user is owner');
    }

    private function testWithNotOwnerRegularUser()
    {
        $this->createRegularUserEnv(array('id' => self::CORRECT_TEST_USER_ID));
        $ownerMiddleware = new \Fileshare\Middlewares\OwnerMiddleware($this->container);
        $ownerMiddleware($this->request, $this->response, function ($request, $response) { return $response; });
        $ownerMiddlewareReflection = new \ReflectionClass(get_class($ownerMiddleware));
        $ownerMiddlewareIdProperty = $ownerMiddlewareReflection->getProperty('id');
        $ownerMiddlewareIdProperty = $ownerMiddlewareIdProperty->setAccessible(true);
        $ownerMiddlewareIdProperty->setValue($ownerMiddlewareReflection, self::INCORRECT_TEST_USER_ID);
        $ownerMiddlewareUserIsOwnerMetod = $ownerMiddlewareReflection->getMethod('userIsOwner');
        $ownerMiddlewareUserIsOwnerMetod->setAccessible(true);
        $this->tester->assertFalse($ownerMiddlewareUserIsOwnerMetod->invoke($ownerMiddleware), 'must return false, because user is not owner');
    }
}
