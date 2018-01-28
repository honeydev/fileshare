<?php
/**
 * @class BaseTest contain basic methods for my functional tests
 */
declare(strict_types=1);

namespace FileshareTests\Functional;

use \Codeception\Util;

abstract class BaseTest extends \Codeception\Module
{
    use \FileshareTests\traits\CreateFakeUserTrait;
    /** @object \FunctionalTester @class*/
    protected $tester;
    /** @param string */
    protected $testUserId;

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

    protected function createRegularUser(): string
    {
        $userId = $this->createUser(array(
            'users' => ['email' => 'testuser@test.com', 'hash' => password_hash('testuserpassword', PASSWORD_DEFAULT)],
            'usersInfo' => ['name' => 'testuser'],
            'usersSettings' => ['accessLvl' => '1']
        ));
        return $userId;
    }

    protected function loginTestUser(array $userData)
    {
        $this->tester->sendAjaxPostRequest('/login.form', array(
            'email' => $userData['email'], 'password' => $userData['password']
        ));
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array("status" => "success"));
    }
}
