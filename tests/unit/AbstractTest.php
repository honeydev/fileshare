<?php

namespace FileshareTests\unit;

use Codeception\Util\Fixtures;

abstract class AbstractTest extends \Codeception\Test\Unit
{
    use \FileshareTests\unit\traits\CreateUserSessionTrait;
    use \FileshareTests\unit\traits\CreateRequestTrait;
    use \FileshareTests\unit\traits\CreateResponseTrait;


    protected $container;

    public function __construct()
    {
        parent::__construct();
        $this->container = Fixtures::get('container');
    }

    protected function createRegularUserEnv(array $requestBody = array())
    {
        $this->sessionModel = $this->createRegularUserSession($this->container);
        $this->request = $this->createRequest($this->container, $requestBody);
        $this->response = $this->createResponse($this->container);
    }

    protected function createAdminUserEnv(array $requestBody = array())
    {
        $this->sessionModel = $this->createAdminUserSession($this->container);
        $this->request = $this->createRequest($this->container, $requestBody);
        $this->response = $this->createResponse($this->container);
    }
}
