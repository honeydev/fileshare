<?php
/**
 * @class check login request
 */

declare(strict_types=1);

namespace FileshareTests\functional;

use \Fileshare\Models\User;
use \Fileshare\Models\UserInfo;
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
        $user = $this->userProvide();
        $this->tester->wantTo('Login user');
        //$this->tester->seeResponseCodeIs(200);
        $this->tester->sendAjaxRequest('POST', '/login.form', array("email" => $user->email, "password" => "12345"));
        $this->tester->seeResponseContainsJson(array("status" => "success", "loginData" => [
                "id" => $user->id,
                "email" => $user->email,
                "token" => $user->token,
                "name" => $user->userInfo->name,
                "avatarUri" => $user->userInfo->avatarUri,
                "accountStatus" => $user->userSettings->accountStatus,
                "accessLvl" => $user->userSettings->accessLvl
        ]));
    }
    /**
     * @return \Fileshare\Models\User;
     */
    private function userProvide(): User
    {
        $user = User::create([
            "email" => "testusertest@test.com",
            "password" => password_hash('12345', PASSWORD_DEFAULT)
        ]);
        $user->userInfo()->create(["name" => "testname", "user_id" => $user->id]);
        $user->userSettings()->create(["account_status" => 1, "access_lvl" => 1]);
        return $user;
    }
}

$loginUserCept = new LoginUserCept(new \FunctionalTester($scenario));
$loginUserCept->sendRequestOnLogin();