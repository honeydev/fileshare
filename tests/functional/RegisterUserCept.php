<?php
/**
 * @class SetNewAvatarCept
 */

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use Fileshare\Models\User;
use Fileshare\Models\UserInfo;

class RegisterUserCept extends AbstractTest
{
    public function __construct(\FunctionalTester $tester)
    {
        parent::__construct($tester);
        $this->setXhrRequestType();
        $this->setUserIp();
        $this->setSession();
    }

    public function sendRequestOnReg()
    {
        $faker = \Faker\Factory::create();
        $this->tester->wantTo('Register new user');
        $this->tester->wantTo('See complete request with uri my avatar');
        $userData = array(
            "email" => $faker->email,
            "password" => "12345",
            "passwordRepeat" => "12345",
            "name" => "tester",
            "accessLvl" => 1
        );
        $this->tester->sendAjaxRequest('POST', '/api/register.form', $userData);
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array(
            "status" => "success",
            "email" => $userData["email"],
            "name" => $userData["name"],
            "accessLvl" => $userData["accessLvl"]
            )
        );
    }
}

$registerUserCept = new RegisterUserCept(new \FunctionalTester($scenario));
$registerUserCept->sendRequestOnReg();