<?php

namespace FileshareTests;


class PasswordValidatorTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $passwordValidator;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->passwordValidator = new \Fileshare\Validators\PasswordValidator();
        $this->testCorrectPasswords();
        $this->testIncorrectPasswords();
    }

    private function testCorrectPasswords()
    {
        define('CORRECT_PASSWORDS', [
            'password', 'asdasdas', 'q12asd', 'adASdAS!21', 'AAASS22qwe',
            'asd!2123!~', '~!#$%&*()-_+=', 'a123$%0a1', 'JqeRsnm%%#@'
        ]);

        for ($i = 0; $i < count(CORRECT_PASSWORDS); $i++) {
            $this->tester->assertTrue($this->passwordValidator->validate(CORRECT_PASSWORDS[$i]));
        }
    }

    private function testIncorrectPasswords()
    {
        define('INCORRECT_PASSWORDS', [
            '', ' ', ' SSDS', ' password', '"pzaS',
            "'AS1as", '\\asdaas1', '<>asd12', 'aaaaaaaaaaa221aaaaaaaaaaaaa',
            '`dasdfaads`'
        ]);

        for ($i = 0; $i < count(INCORRECT_PASSWORDS); $i++) {
            $invalidPassword = INCORRECT_PASSWORDS[$i];
            $this->tester->expectException('Fileshare\Exceptions\ValidateException', function () use ($invalidPassword) {
                $this->passwordValidator->validate($invalidPassword);
            });
        }
    }
}
