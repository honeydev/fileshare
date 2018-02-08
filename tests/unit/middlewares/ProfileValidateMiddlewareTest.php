<?php

namespace FielshareTests\unit\middleware;

use \Codeception\Util\Debug as debug;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ProfileValidateMiddlewareTest extends \FileshareTests\unit\AbstractTest
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

    public function __construct()
    {
        parent::__construct();
    }

    protected function _before()
    {
        $this->correctUserId = $this->createUser([
            'users' => ['email' => 'testuser@test.com', 'hash' => 'fakehash']
        ]);
        $this->createRegularUserEnv(array('id' => $this->correctUserId));
    }

    public function testSomeFeature()
    {
        $this->testProfileDataWithCorrectValues();
    }

    private function testProfileDataWithCorrectValues()
    {
        $this->request->withParsedBody(
            array(
                'email' => 'newemail@email.com', 
                'name' => 'new name'
                //add passwords
                //fix front end
            )
        );
        $this->tester->assertInstanceOf(
            '\Psr\Http\Message\ResponseInterface',
            (new \Fileshare\Middlewares\ProfileValidateMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                return $response;
            }, 'must return response without exceptions')
        );
    }
}
