<?php

class SeeProfileDataChangeResponseCept
{
    public function __construct()
    {
        $this->setHeaders();
    }

    private function setHeaders()
    {
        //$_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REMOTE_ADDR'] = '192.168.4.15';
    }

    public function login(FunctionalTester $I)
    {
        // $I->setCookie('PHPSESSID', 'el4ukv0kqbvoirg7nkp4dncpk3');
        // $I->seeCookie('PHPSESSID');
        $I->sendAjaxPostRequest('/login.form', array('email' => 'testuser@test.com', 'password' => 'password'));
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(array("status" => "success"));
    }

    public function sendProfileChange(FunctionalTester $I)
    {
        $I->sendAjaxPostRequest("/profile.form", array('email' => 'newEmail@email.com', 'name' => 'new name'));
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson(array("status" => "success"));
	}
}

$seeProfileDataChangeResponseCept = new SeeProfileDataChangeResponseCept();
$seeProfileDataChangeResponseCept->login(new FunctionalTester($scenario));
//$seeProfileDataChangeResponseCept->sendProfileChange(new FunctionalTester($scenario));