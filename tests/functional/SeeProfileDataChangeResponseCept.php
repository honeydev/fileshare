<?php

$I = new FunctionalTester($scenario);
$I->wantTo('Get ajax response about succesful profile data');
$newProfileData = ["email" => "newemail@email.com"];
$I->sendAjaxPostRequest("/login.form", ["email" => "testuser@test.com","password" => "password"]);
// $I->sendAjaxPostRequest("/profile.form", $newProfileData);
// $I->seeResponseCodeIs(200);
$I->seeResponseContains("testuser@test.com");