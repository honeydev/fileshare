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
    /**
     * @property array
     */
    private $correctProfileData = array(
        'email' => 'newemail@email.com',
        'password' => 'password',
        'passwordRepeat' => 'password',
        'name' => 'newname'
    );

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
        $this->createGuestSessionEnv($this->correctProfileData);
        $response = (new \Fileshare\Middlewares\RegValidateMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
            return $response;
        });
        $responseContent = $this->prepareResponseContent($response);
        $this->tester->assertEquals(EMPTY_BODY, $responseContent);
    }

    private function validateIncorrectData()
    {
        define('INCORRECT_PROFILE_DATA', array(
            'email' => 'incorrectemail.com',
            'name' => '##$@',
            'password' => '1a',
            'passwordRepeat' => 'not_equal_password'
        ));

        foreach (INCORRECT_PROFILE_DATA as $incorrectPropertyName => $incorrectPropertyValue) {
            $incorrectProfileData = array_merge($this->correctProfileData, array($incorrectPropertyName => $incorrectPropertyValue));
            $this->createGuestSessionEnv($incorrectProfileData);
            $response = (new \Fileshare\Middlewares\RegValidateMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                return $response;
            });
            $responseContent = $this->prepareResponseContent($response);
            $this->tester->assertArraySubset(['status' => 'failed', 'errorType' => 'invalid_registration_data'], $responseContent);
        }
    }
}
