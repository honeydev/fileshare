<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use \Fileshare\Db\factories\UserFactory;
use \Fileshare\Models\User;
use Codeception\Util\Fixtures;

class ProfileChangeCept extends AbstractTest
{
    public function __construct($tester)
    {
        parent::__construct($tester);
        $this->container = Fixtures::get("container");
    }

    public function testChangeProfileUserWithCorrectRequest()
    {
        $cryptoService = $this->container->get("CryptoService");
        $this->tester->wantTo('Change user profile data');
        $user = UserFactory::createRegularUser();
        $this->loginUser($user);
        $newProfileData = [
            'email' => "newemail@email.com",
            "name" => "new name",
            "currentPassword" => 'password',
            'newPassword' => "newpass",
            'repeatNewPassword' => "repeatNewPassword",
            'id' => $user->id,
            "targetProfileId" => $user->id,
            'token' => User::find($user->id)->token,
        ];
        $this->tester->sendAjaxPostRequest('/profile.form', $newProfileData);
        $this->tester->seeResponseContainsJson(array("status" => "success", "user" => [
            "email" => $newProfileData["email"],
            "name" => $newProfileData["name"],
            "password" => $cryptoService->getPasswordHash($newProfileData['newPassword']),
            "id" => $newProfileData["id"],
            "targetProfileId" => $user->id,
            "token" => User::find($user->id)->token
         ]));
    }

    public function testChangeProfileUserWithInvalidToken()
    {
        $this->tester->wantTo('See 401 error, invalid token');
        $user = UserFactory::createRegularUser();
        $this->loginUser($user);
        $newProfileData = [
            'email' => "newemail@email.com",
            "name" => "new name",
            "currentPassword" => 'password',
            'newPassword' => "newpass",
            'repeatNewPassword' => "repeatNewPassword",
            'id' => $user->id,
            "targetProfileId" => $user->id,
            'token' => 'invalid_token'
        ];
        $this->tester->sendAjaxPostRequest('/profile.form', $newProfileData);
        $this->tester->seeResponseContainsJson(["status" => "failed", "errorType" => "invalid_request_token"]);
        $this->tester->seeResponseCodeIs(401);
    }

    public function testChangeProfileInvalidRequestWithoutUserId()
    {
        $this->tester->wantTo('See 401 error, request did\'t have "id" in request');
        $user = UserFactory::createRegularUser();
        $this->loginUser($user);
        $newProfileData = [
            'email' => "newemail@email.com",
            "name" => "new name",
            "currentPassword" => 'password',
            'newPassword' => "newpass",
            'repeatNewPassword' => "repeatNewPassword",
            "targetProfileId" => $user->id,
            'token' => User::find($user->id)->token
        ];
        $this->tester->sendAjaxPostRequest('/profile.form', $newProfileData);
        $this->tester->seeResponseContainsJson(["status" => "failed", "errorType" => "request_not_contain_auth_info"]);
        $this->tester->seeResponseCodeIs(401);
    }

    public function testChangeProfileWithInvalidTargetProfileId()
    {
        $this->tester->wantTo('See 550 error, permission denied');
        $user = UserFactory::createRegularUser();
        $this->loginUser($user);
        $newProfileData = [
            'email' => "newemail@email.com",
            "name" => "new name",
            "currentPassword" => 'password',
            'newPassword' => "newpass",
            'repeatNewPassword' => "repeatNewPassword",
            'id' => $user->id,
            "targetProfileId" => $notThisUserId = $user->id + 1,
            'token' => User::find($user->id)->token
        ];
        $this->tester->sendAjaxPostRequest('/profile.form', $newProfileData);
        $this->tester->seeResponseContainsJson(["status" => "failed", "errorType" => "permission_denied"]);
        $this->tester->seeResponseCodeIs(403);
    }

    private function loginUser($user)
    {
        $this->tester->sendAjaxRequest('POST', '/login.form', array("email" => $user->email, "password" => 'password'));
        $this->tester->seeResponseCodeIs(200);
    }
}

$profileChangeCept = new ProfileChangeCept(new \FunctionalTester($scenario));
$profileChangeCept->testChangeProfileUserWithCorrectRequest();
$profileChangeCept->testChangeProfileUserWithInvalidToken();
$profileChangeCept->testChangeProfileInvalidRequestWithoutUserId();
$profileChangeCept->testChangeProfileWithInvalidTargetProfileId();