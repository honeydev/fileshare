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
        $this->validateIncorrectData();
    }

    private function validateCorrectRegData()
    {
        define('EMPTY_BODY', '');
        $this->createGuestSessionEnv(
            array(
                'email' => 'newemail@email.com',
                'name' => 'new name',
                'password' => 'password',
                'passwordRepeat' => 'password'
            )
        );
        $response = (new \Fileshare\Middlewares\RegValidateMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
            return $response;
        });

        $responseContent = $this->prepareResponseContent($response);
        $this->tester->assertEquals(EMPTY_BODY, $responseContent);
    }

    private function validateIncorrectData()
    {
        $this->withIncorrectEmail();
        $this->withIncorrectName();
        $this->withIncorrectName();
        $this->withNotEqualPasswords();
        $this->withInvalidPassword();
    }

    private function withIncorrectEmail()
    {
        $requestBody = array(
            'email' => 'newemailemail.com',
            'name' => 'new name',
            'password' => 'password',
            'passwordRepeat' => 'passworder'
        );
        $this->createGuestSessionEnv($requestBody);
        $response = (new \Fileshare\Middlewares\RegValidateMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
            return $response;
        });
        $responseContent = $this->prepareResponseContent($response);
        //todo write asssert - array must contain registration failed status
    }

    private function withIncorrectName()
    {

    }

    private function withNotEqualPasswords()
    {

    }

    private function withInvalidPassword()
    {

    }
}
