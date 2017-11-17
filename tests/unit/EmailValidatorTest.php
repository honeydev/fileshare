<?php

namespace FileshareTests;

class EmailValidatorTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $emailValidator;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->emailValidator = new \Fileshare\Validators\EmailValidator();
        $this->testCorrectEmails();
        $this->testIncorrectEmails();
    }

    private function testCorrectEmails()
    {
        define('VALID_EMAILS', [
            'mail@gmail.com', 'mail.mail@gmail.com', 'mail_4123@mail.com', 'mail_76542@mail.de', '888asdasdas@outlook.com',
        ]);

        for ($i = 0; $i < count(VALID_EMAILS); $i++) {
            $this->tester->assertTrue($this->emailValidator->validate(VALID_EMAILS[$i]));
        }
    }

    private function testIncorrectEmails()
    {
        define('INVALID_EMAILS', [
          ' mail@gmail.com', 'mail @gmail.com', 'maiL,@gnail.com', 'mail@gmail..com',
            'mail@@gmail.com'
        ]);

        for ($i = 0; $i < count(INVALID_EMAILS); $i++) {
            $invalidEmail = INVALID_EMAILS[$i];
            $this->tester->expectException('Fileshare\Exceptions\FileshareException', function () use ($invalidEmail) {
                $this->emailValidator->validate($invalidEmail);
            });
        }
    }
}