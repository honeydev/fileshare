<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use \Fileshare\Db\factories\UserFactory;

class ProfileChangeCept extends AbstractTest
{
    public function testChangeProfileUserWithCorrectToken()
    {
        $this->tester->wantTo('Change user profile data');
        $user = UserFactory::createRegularUser();
        $this->loginUser($user);
        debug::debug("!!!!!!!!");
        debug::debug($user->token);
        debug::debug($user::find($user->id)->token);
        $newProfileData = [
            'email' => "newemail@email.com",
            "name" => "new name",
            "currentPassword" => 'password',
            'newPassword' => "newpass",
            'repeatNewPassword' => "repeatNewPassword",
            'id' => $user->id,
            'token' => $user->token
        ];
        $this->tester->sendAjaxPostRequest('/profile.form', $newProfileData);
        $this->tester->seeResponseContainsJson(array("status" => "success"));
        $this->assertEquals($newProfileData['email']);
        $this->assertEquals($newProfileData['name']);
        $this->assertEquals($newProfileData['newPassword']);
    }

    private function loginUser($user)
    {
        $this->tester->sendAjaxRequest('POST', '/login.form', array("email" => $user->email, "password" => 'password'));
        $this->tester->seeResponseCodeIs(200);
    }
}

$profileChangeCept = new ProfileChangeCept(new \FunctionalTester($scenario));
$profileChangeCept->testChangeProfileUserWithCorrectToken();
