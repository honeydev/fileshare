<?php

$I = new FunctionalTester($scenario);
$I->wantTo('see my the name i put');
$name = 'herloct';
$I->sendGET("/hello/{$name}");
$I->seeResponseCodeIs(200);
$I->seeResponseContains("Hello, {$name}");