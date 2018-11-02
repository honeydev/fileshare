<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use \Fileshare\Db\factories\UserFactory;
use \Fileshare\Models\User;
use Codeception\Util\Fixtures;
use Faker\Generator as Faker;

class ProfileChangeCept extends AbstractTest
{
    public function __construct($tester)
    {
        parent::__construct($tester);
        $this->container = Fixtures::get("container");
        $this->cryptoService = $this->container->get('CryptoService');
    }

    public function testChangeProfileUserWithCorrectRequest()
    {
        $faker = \Faker\Factory::create();
        $this->tester->wantTo('Change user profile data');
        $user = UserFactory::createRegularUser($this->container);
        $this->tester->haveHttpHeader("Authorization", "Bearer {$user->token}");
        $this->tester->haveHttpHeader("Content-type", "application/json");
        $this->loginUser($user);
        $newProfileData = [
            'email' => $faker->email,
            "name" => "new name",
            "currentPassword" => 'password',
            'newPassword' => "newpass",
            'repeatNewPassword' => "newpass",
            "targetProfileId" => $user->id
        ];
        $this->tester->sendAjaxPostRequest('/api/profile.form', $newProfileData);
        $this->tester->seeResponseContainsJson(array("status" => "success", "user" => [
            "email" => $newProfileData["email"],
            "name" => $newProfileData["name"],
            "id" => $user->id
         ]));
        $user = User::find($user->id);
        $this->assertEquals($newProfileData['email'], $user->email);
        $this->assertEquals($newProfileData['name'], $user->userInfo->name);
        $this->assertTrue($this->cryptoService->passwordVerify('newpass', $user->password));
    }

    public function testChangeProfileWithInvalidTargetProfileId()
    {
        $this->tester->wantTo('See 550 error, permission denied');
        $user = UserFactory::createRegularUser($this->container);
        $this->loginUser($user);
        $newProfileData = [
            'email' => "newemail@email.com",
            "name" => "new name",
            "currentPassword" => 'password',
            'newPassword' => "newpass",
            'repeatNewPassword' => "repeatNewPassword",
            'id' => $user->id,
            "targetProfileId" => $notThisUserId = $user->id + 1,
        ];
        $this->tester->sendAjaxPostRequest('/api/profile.form', $newProfileData);
        $this->tester->seeResponseContainsJson(["status" => "failed", "errorType" => "permission_denied"]);
        $this->tester->seeResponseCodeIs(403);
    }
}

$profileChangeCept = new ProfileChangeCept(new \FunctionalTester($scenario));
$profileChangeCept->testChangeProfileUserWithCorrectRequest();
$profileChangeCept->testChangeProfileWithInvalidTargetProfileId();