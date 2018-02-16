<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;

class SeeProfileDataChangeResponseCept extends BaseTest
{

    public function __construct(\FunctionalTester $tester)
    {
        parent::__construct($tester);
        $this->setXhrRequestType();
        $this->setUserIp();
        $this->testUserId = $this->createRegularUser();
        $this->loginTestUser(array('email' => 'testuser@test.com', 'password' => 'testuserpassword'));
    }

    public function sendValidProfileChanges()
    {
         $this->loginTestUser(array('email' => 'testuser@test.com', 'password' => 'testuserpassword'));
        $this->tester->wantTo('See coomplete request');
        $this->tester->sendAjaxPostRequest(
            "/profile.form", 
            array(
                'email' => 'testuser@test.com', 
                'name' => 'new name', 
                'id' => $this->testUserId
                )
            );
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array("status" => "success"));
    }

    public function sendRequestWithInvalidData()
    {
        $this->tester->wantTo('See error response on invalid request');
        $this->tester->sendAjaxPostRequest(
            '/profile.form', 
            array(
                'email' => ' asd', 
                'id' => $this->testUserId
                )
            );
        $this->tester->seeResponseCodeIs(401);
        $this->tester->seeResponseContainsJson(
            array(
                "status" => "failed",
                "errorType" => "invalid_new_profile_data"
                )
            );
    }

    public function sendNotOwnerRequest()
    {
        define('NOT_OWNER_ID', 777);
        $this->tester->wantTo('See error response on not profile owner request');
        $this->tester->sendAjaxPostRequest(
            '/profile.form', 
            array(
                'email' => 'newemail@email.com', 
                'id' => NOT_OWNER_ID
                )
            );
        $this->tester->seeResponseCodeIs(401);
        $this->tester->seeResponseContainsJson(
            array(
                "status" => "failed",
                "errorType" => "user_cant_change_this_profile"
                )
            );
    }
}

$seeProfileDataChangeResponseCept = new SeeProfileDataChangeResponseCept(new \FunctionalTester($scenario));
$seeProfileDataChangeResponseCept->sendValidProfileChanges();
$seeProfileDataChangeResponseCept->sendRequestWithInvalidData();
