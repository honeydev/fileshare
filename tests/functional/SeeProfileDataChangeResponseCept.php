<?php

declare(strict_types=1);

namespace FileshareTests\functional;

class SeeProfileDataChangeResponseCept extends BaseTest
{

    public function __construct(\FunctionalTester $tester)
    {
        parent::__construct($tester);
        $this->setXhrRequestType();
        $this->setUserIp();
        $this->setSessionId();
        $this->testUserId = $this->createRegularUser();
        $this->loginTestUser(array('email' => 'testuser@test.com', 'password' => 'testuserpassword'));
    }

    public function sendValidProfileChanges()
    {
        $this->tester->wantTo('See coomplete request');
        $this->tester->sendAjaxPostRequest("/profile.form", array('email' => 'testuser@test.com', 'name' => 'new name', 'id' => $this->testUserId));
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array("status" => "success"));
    }

    public function sendRequestWithInvalidData()
    {
        $this->tester->wantTo('See error response on invalid request');
        $this->tester->sendAjaxPostRequest('/profile.form', array('eset' => 'nwewwaws', 'name' => ''));
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array("status" => "failed"));
    }
}

$seeProfileDataChangeResponseCept = new SeeProfileDataChangeResponseCept(new \FunctionalTester($scenario));
$seeProfileDataChangeResponseCept->sendValidProfileChanges();
$seeProfileDataChangeResponseCept->sendRequestWithInvalidData();
