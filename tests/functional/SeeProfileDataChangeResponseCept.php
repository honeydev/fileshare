<?php

$I = new FunctionalTester($scenario);
$I->wantTo('Get ajax response about succesful profile data');
$newProfileData = ["email" => "newemail@email.com"];
$I->sendAjaxPostRequest("/profile.form", $newProfileData);
$I->seeResponseCodeIs(200);
$I->seeResponseContains("success");