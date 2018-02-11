<?php
/**
 * @class RegValidateMiddlewareTest
 */

declare(strict_types=1);

namespace FileshareTests\unit\middlewares;

use \Codeception\Util\Debug as debug;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class RegValidateMiddlewareTest extends \FileshareTests\unit\AbstractTest
{
    use \FileshareTests\unit\traits\CreateFakeUserTrait;
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @property \Fileshare\Models\SessionModel
     */

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
        $this->validateCorrectRegData();
    }

    private function validateCorrectRegData()
    {
            $this->addInRequestCorrectUserData();
            $response = (new \Fileshare\Middlewares\OwnerMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                return $response;
            });
            $responseBody = $response->getBody();
            $this->tester->assertArrayNotHasKey('regStatus', $responseBody);
    }

    private function addInRequestCorrectUserData()
    {
        $this->request->withParsedBody(
            array(
                'email' => 'newemail@email.com',
                'name' => 'new name',
                'password' => 'password',
                'passwordRepeat' => 'password'
            )
        );
    }
}
