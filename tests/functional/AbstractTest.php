<?php
/**
 * @class AbstractTest contain basic methods for my functional tests
 */
declare(strict_types=1);

namespace FileshareTests\Functional;

use \Codeception\Util;
use \Codeception\Util\Debug as debug;

abstract class AbstractTest extends \Codeception\Module
{
    /** @var \FunctionalTester */
    protected $tester;
    /** @param string */
    protected $testUserId;

    public function __construct(\FunctionalTester $tester)
    {
        $this->tester = $tester;
    }

    protected function setXhrRequestType()
    {
        $this->tester->haveHttpHeader('X-Requested-With', 'XMLHttpRequest');
    }

    protected function setUserIp(string $ip = '192.168.4.15')
    {
        $_SERVER['REMOTE_ADDR'] = $ip;
    }

    protected function setSession(string $id = 'el4ukv0kqbvoirg7nkp4dncpk3')
    {
        $this->tester->setCookie('PHPSESSID', $id);
        $this->tester->seeCookie('PHPSESSID');
    }

    protected function loginUser($user)
    {
        $this->tester->sendAjaxRequest('POST', '/api/login.form', array("email" => $user->email, "password" => 'password'));
        // $this->tester->seeResponseCodeIs(200);
    }

    protected function loginTestUser(array $userData)
    {
        $this->tester->sendAjaxPostRequest('/api/login.form', array(
            'email' => $userData['email'], 'password' => $userData['password']
        ));
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array("status" => "success"));
    }

    protected function getFileShortName(string $imageUri): string
    {
        $uri = explode('/', $imageUri);
        return $uri[count($uri) - 1];
    }
}
