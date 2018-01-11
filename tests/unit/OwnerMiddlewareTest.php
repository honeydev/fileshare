<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;

class OwnerMiddlewareTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $container;
    private $ownerMiddleware;

    public function __construct()
    {
        parent::__construct();
        $this->container = Fixtures::get('container');
        $this->ownerMiddleware = new \Fileshare\Middlewares\OwnerMiddleware($this->container);
        var_dump($this->ownerMiddleware);
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

    }
}