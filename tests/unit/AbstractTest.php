<?php

declare(strict_types=1);

namespace FileshareTests\unit;

use Codeception\Util\Fixtures;

abstract class AbstractTest extends \Codeception\Test\Unit
{
    use \FileshareTests\unit\traits\CreateUserSessionTrait;
    use \FileshareTests\unit\traits\CreateRequestTrait;
    use \FileshareTests\unit\traits\CreateResponseTrait;
    /** @property string */
    protected $logsDir;
    protected $container;

    public function __construct()
    {
        parent::__construct();
        $this->container = Fixtures::get('container');
        $this->logsDir = $this->logsDir = dirname(dirname(__DIR__)) . "/logs/";
    }

    protected function createGuestSessionEnv(array $requestBody = array())
    {
        //todo implement
        $this->sessionModel = $this->createGuestSession($this->container);
        $this->request = $this->createRequest($this->container, $requestBody);
        $this->response = $this->createResponse($this->container);
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
