<?php
/**
 * @class check login request
 */
declare(strict_types=1);

namespace FileshareTests\functional;

use \Fileshare\Models\User;
use \Fileshare\Models\UserInfo;
use \Fileshare\Models\UserSettings;
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
        $this->tester->sendAjaxRequest('POST', '/login.form', array("email" => $user->email, "password" => "12345"));
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array("status" => "success", "loginData" => [
                "id" => $user->id,
                "email" => $user->email,
                "name" => $user->userInfo->name,
                "avatarUri" => $user->userInfo->avatarUri,
                "accountStatus" => $user->userSettings->accountStatus,
                "accessLvl" => $user->userSettings->accessLvl
        ]));

        debug::debug("!!!!!!!");
        debug::debug($user->token);
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

        $userSettings = new UserSettings();
        $userSettings->accountStatus = 1;
        $userSettings->accessLvl = 1;
        $user->userSettings()->save($userSettings);

        return $user;
    }
}

$loginUserCept = new LoginUserCept(new \FunctionalTester($scenario));
$loginUserCept->sendRequestOnLogin();