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
        
        $newProfileData = [
            'email' => "newemail@email.com",
            "name" => "new name",
            "currentPassword" => 'password',
            'newPassword' => "newpass",
            'repeatNewPassword' => "repeatNewPassword"
        ];

        $this->tester->sendAjaxPostRequest('/profile.form', $newProfileData);
        $this->tester->seeResponseContainsJson(array("status" => "success"));
        debug::debug($user);
    }
}

$profileChangeCept = new ProfileChangeCept(new \FunctionalTester($scenario));
$profileChangeCept->testChangeProfileUserWithCorrectToken();