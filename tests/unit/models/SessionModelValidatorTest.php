<?php

namespace FileshareTests;

class SessionModelValidatorTest extends \Codeception\Test\Unit
{
    protected $tester;
    private $sessionValidator;
    // tests
    public function testSomeFeature()
    {
        $this->sessionValidator = new \Fileshare\Validators\SessionModelValidator;
        $this->testIncorrectKeys();
        $this->testAccessLvl();
        $this->testIp();
    }

    private function testAccessLvl()
    {
        $this->testCorrectAccessLvl();
        $this->testIncorrectAccessLvl();
    }

    private function testIncorrectKeys()
    {
        define('INCORRECT_KEYS', [0, 'incorrect_key', 'sdasasdasd']);

        for ($i = 0; $i < count(INCORRECT_KEYS); $i++) {
            $this->callWithIncorrectKey(INCORRECT_KEYS[$i]);
        }
    }

    private function callWithIncorrectKey($incorrectKey)
    {
        $this->tester->expectException('\UnexpectedValueException', function () use ($incorrectKey) {
            $this->sessionValidator->validate([
                'propertyName' => $incorrectKey,
                'propertyValue' => 0
            ]);
        });
    }

    private function testCorrectAccessLvl()
    {
        define('MAXIMAL_LVL', 3);

        for ($accessLvl = 0; $accessLvl < MAXIMAL_LVL; $accessLvl++) {
            $this->assertTrue(
                $this->sessionValidator->validate([
                    'propertyName' => 'accessLvl',
                    'propertyValue' => $accessLvl
                ])
            );
        }
    }

    private function testIncorrectAccessLvl()
    {
        define('INCORRECT_LVLS', [-100, 5, 4, 'admin']);

        for ($i = 0; $i < count(INCORRECT_LVLS); $i++) {
            $incorrectLvl = INCORRECT_LVLS[$i];
            $this->tester->expectException('\Exception', function () use ($incorrectLvl) {
                $this->sessionValidator->validate([
                    'propertyName' => 'accessLvl',
                    'propertyValue' => $incorrectLvl
                ]);
            });
        }
    }

    private function testIp()
    {
        $this->testCorrectIp();
        $this->testIncorrectIp();
    }

    private function testCorrectIp()
    {
        define('CORRECT_ADDRESSES', [
            '127.0.0.1', '192.168.1.1', '92.37.143.143', '0.0.0.0', '255.255.255.255',
            '60.40.39.17', '51.06.32.33', '77.77.77.77', '15.15.22.44', '34.22.22.00',
            '6.4.0.19', '0.77.255.1', '2.20.222.2'
        ]);

        for ($i = 0; $i < count(CORRECT_ADDRESSES); $i++) {
            $this->tester->assertTrue(
                $this->sessionValidator->validate([
                    'propertyName' => 'ip',
                    'propertyValue' => CORRECT_ADDRESSES[$i]
                ])
            );
        }
    }

    private function testIncorrectIp()
    {
        define('INCORRECT_ADDRESSES', [
            '', '266.14.2222.1', '0000.0000.000.00', '192.168.1.1.1', '127.9.9.9.12',
            '66.6666.6.6', '-14.2323.22.1', '88.44.44.44.4', '16.16.16', '7.7',
            '122', '122.67.44', '122.44.223.444', '33.32.555.12', '17.12.111.1.5'
        ]);

        for ($i = 0; $i < count(INCORRECT_ADDRESSES); $i++) {
            $incorrectAddress = INCORRECT_ADDRESSES[$i];
            $this->tester->expectException('\Exception', function () use ($incorrectAddress) {
                $this->sessionValidator->validate([
                    'propertyName' => 'ip',
                    'propertyValue' => $incorrectAddress
                ]);
            });
        }
    }
}
