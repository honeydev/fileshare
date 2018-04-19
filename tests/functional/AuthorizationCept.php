<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use Faker\Generator as Faker;

class AuthorizationCept extends AbstractTest
{
    public function __construct(\FunctionalTester $tester)
    {
        parent::__construct($tester);
    }

    public function testLogin()
    {
        $faker = \Faker\Factory::create();
        $user = \Fileshare\Models\User::create([
            "email" => $faker->email,
            "password" => $faker->password,
            "role" => "member"
        ]);
        $this->tester->sendAjaxRequest('POST', '/login', array(
            'email' => $user->email,
            'password' => $user->password
        ));
        $this->tester->seeResponseContainsJson(array("status" => "success"));
    }
}

$authorizationCept = new AuthorizationCept(new \FunctionalTester($scenario));
$authorizationCept->testLogin();