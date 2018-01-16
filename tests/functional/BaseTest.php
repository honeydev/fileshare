<?php
/**
 * @class BaseTest contain basic methods for my functional tests
 */
declare(strict_types=1);

namespace FileshareTests\Functional;

use \Codeception\Util;

abstract class BaseTest extends \Codeception\Module
{
    /** @object \FunctionalTester @class*/
    protected $tester;
    /** @int */
    const TEST_USER_ID = 7;

    public function __construct(\FunctionalTester $tester)
    {
        $this->tester = $tester;
    }

    protected function setXhrRequestType()
    {
        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
    }

    protected function setUserIp(string $ip = '192.168.4.15')
    {
        $_SERVER['REMOTE_ADDR'] = $ip;
    }

    protected function setSessionId(string $id = 'el4ukv0kqbvoirg7nkp4dncpk3')
    {
        $this->tester->setCookie('PHPSESSID', $id);
        $this->tester->seeCookie('PHPSESSID');
    }

    protected function loginTestUser()
    {
        $this->tester->sendAjaxPostRequest('/login.form', array('email' => 'testuser@test.com', 'password' => 'password'));
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array("status" => "success"));
    }
}