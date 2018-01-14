<?php

$I = new FunctionalTester($scenario);
$I->haveHttpHeader('X-Requested-With', 'XMLHttpRequest');
$I = new FunctionalTester($scenario);
$I->sendAjaxPostRequest("/profile.form", array('email' => 'newEmail@email.com', 'name' => 'new name'));
$I->seeResponseCodeIs(200);
$I->seeResponseContainsJson(array("status" => "success"));

