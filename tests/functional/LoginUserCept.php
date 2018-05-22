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
        $userInfo = $user->userInfo();
        $this->tester->wantTo('Login user');
        //$this->tester->seeResponseCodeIs(200);
        $this->tester->sendAjaxRequest('POST', '/login.form', array("email" => $user->email, "password" => "12345"));
        $this->tester->seeResponseContainsJson(array("status" => "success", "loginData" => [
                "id" => $user->id,
                "email" => $user->email,
                // "token" => $user->token,
                "name" => $userInfo->name,
                // "avatarUri" => $user->userInfo->avatarUri,
                // "accountStatus" => 1,
                // "accessLvl" => $user->userSettings->accessLvl
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
        $userInfo = new UserInfo();
        $userInfo->name = "user name";
        $userInfo->avatarUri = "uri";
        $user->userInfo()->save($userInfo);

        debug::debug("!!!!!!");
        debug::debug($user->userInfo->name);
        debug::debug($user->userInfo->avatarUri);
        debug::debug($user->userInfo->userId);
    }
}

$loginUserCept = new LoginUserCept(new \FunctionalTester($scenario));
$loginUserCept->sendRequestOnLogin();