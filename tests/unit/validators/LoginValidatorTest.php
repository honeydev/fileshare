<?php

namespace FileshareTests;

class LoginValidatorTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $loginValidator;

    protected function _before()
    {
    }

    protected function _after()
    {
    }
    // tests
    public function testSomeFeature()
    {
        $this->loginValidator = new \Fileshare\Validators\LoginValidator();
        $this->testValidLogins();
        $this->testInvalidLogins();
    }

    private function testValidLogins()
    {
        define('VALID_LOGINS', [
           'user', 'name', 'alexey', 'masdadasd', 'asdasdas',
           'ASDASDA', 'a6', 'g4', 'e666', 'Y7a423A1', 'user-name',
            'user_name', 'honey.white'
        ]);

        for ($i = 0; $i < count(VALID_LOGINS); $i++) {
            $this->tester->assertTrue($this->loginValidator->validate(VALID_LOGINS[$i]));
        }
    }
    private function testInvalidLogins()
    {
        define('INVALID_LOGINS', [
            '', ' ', ' SSDS',
            'user name', '-user', '_user',
            'sddddddddddddddddddddddddddddddddd', 'asda@!%^'
        ]);

        for ($i = 0; $i < count(INVALID_LOGINS); $i++) {
            $invalidLogin = INVALID_LOGINS[$i];
            $this->tester->expectException('Fileshare\Exceptions\FileshareException', function () use ($invalidLogin) {
                $this->loginValidator->validate($invalidLogin);
            });
        }
    }
}