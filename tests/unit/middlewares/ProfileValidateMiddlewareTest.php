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
    /** 
     * @property array
     */
    private $correctProfileData = array(
                'email' => 'newemail@email.com', 
                'name' => 'new name',
                'password' => 'password',
                'passwordRepeat' => 'password'
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

    public function testSomeFeature()
    {
        $this->testProfileDataWithCorrectValues();
        $this->testProfileDataWithIncorrectValues();
    }

    private function testProfileDataWithCorrectValues()
    {
        define('EMPTY_BODY', '');
        $this->createRegularUserEnv($this->correctProfileData);
        $response = (new \Fileshare\Middlewares\ProfileValidateMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                return $response;
            });
        $responseContent = $this->prepareResponseContent($response);
        $this->tester->assertEquals(EMPTY_BODY, $responseContent);
    }

    private function testProfileDataWithIncorrectValues()
    {
        define('INCORRECT_PROFILE_DATA', array(
            'email' => 'incorrectemail.com',
            'name' => '##$@',
            'password' => '1a',
            'passwordRepeat' => 'not_equal_invalid_password<>'
        ));

        foreach (INCORRECT_PROFILE_DATA as $incorrectPropertyName => $incorrectPropertyValue) {
            $incorrectProfileData = array_merge($this->correctProfileData, array($incorrectPropertyName => $incorrectPropertyValue));
            $this->createRegularUserEnv($this->correctProfileData);
            $response = (new \Fileshare\Middlewares\ProfileValidateMiddleware($this->container))($this->request, $this->response, function ($request, $response) {
                    return $response;
            });
            $responseContent = $this->prepareResponseContent($response);

            $this->tester->assertArraySubset(
                [
                    'status' => 'failed', 
                    'errorType' => 'invalid_new_profile_data'
                ], 
                $responseContent
            );
        }

        debug::debug('response content', $responseContent);
    }
}
