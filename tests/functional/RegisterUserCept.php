<?php
/**
 * @class SetNewAvatarCept
 */

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;

class RegisterUserCept extends AbstractTest
{
    public function __construct(\FunctionalTester $tester)
    {
        parent::__construct($tester);
        $this->setXhrRequestType();
        $this->setUserIp();
        $this->setSession();
    }

    public function sendRequestOnReg()
    {
        $this->tester->wantTo('Register new user');
        $this->tester->wantTo('See complete request with uri my avatar');
        $this->tester->sendAjaxRequest('POST', '/register.form', array(
            "email" => "testusertest@test.com",
            "password" => "12345",
            "passwordRepeat" => "12345",
            "name" => "tester",
            "userType" => 1
        ));
        //$this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array("status" => "success"));
    }
}

$registerUserCept = new RegisterUserCept(new \FunctionalTester($scenario));
$registerUserCept->sendRequestOnReg();