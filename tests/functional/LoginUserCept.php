<?php
/**
 * @class check login request
 */
declare(strict_types=1);

namespace FileshareTests\functional;

use \Fileshare\Db\factories\UserFactory;
use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;

class LoginUserCept extends AbstractTest
{
    public function __construct(\FunctionalTester $tester)
    {
        parent::__construct($tester);
        $this->setXhrRequestType();
        $this->setUserIp();
        $this->setSession();
    }

    public function sendRequestOnLogin()
    {
        $user = UserFactory::createRegularUser(Fixtures::get("container"));
        $this->tester->wantTo('Login user');
        debug::debug($user->testPassword);
        $this->tester->sendAjaxRequest('POST', '/login.form', array("email" => $user->email, "password" => $user->nCryptedPassword));
        //$this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array("status" => "success", "loginData" => [
                "id" => $user->id,
                "email" => $user->email,
                "name" => $user->userInfo->name,
                "avatarUri" => $user->userInfo->avatarUri,
                "accountStatus" => $user->userSettings->accountStatus,
                "accessLvl" => $user->userSettings->accessLvl
        ]));
    }
}

$loginUserCept = new LoginUserCept(new \FunctionalTester($scenario));
$loginUserCept->sendRequestOnLogin();