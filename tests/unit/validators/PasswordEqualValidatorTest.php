<?php

declare(strict_types=1);

namespace validators;

class PasswordEqualValidatorTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /** @property \Fileshare\Validators\PasswordEqualValidtor */
    private $passwordEqualValidator;

    protected function _before()
    {
        $this->passwordEqualValidator = new \Fileshare\Validators\PasswordsEqualValidator();
    }

    protected function _after()
    {
    }
    // tests
    public function testSomeFeature()
    {
        $this->testWithEqualPasswords();
        $this->testWithNotEqualPaasswords();
    }

    private function testWithEqualPasswords()
    {
        $this->tester->assertNull($this->passwordEqualValidator->validate(
            ['password' => 'password', 'passwordRepeat' => 'password']
        ));
    }

    private function testWithNotEqualPaasswords()
    {
        $this->tester->expectException('\Fileshare\Exceptions\ValidateException', function () {
            $this->passwordEqualValidator->validate(['password' => 'password', 'passwordRepeat' => 'password_not_equal']);
        });
    }
}
