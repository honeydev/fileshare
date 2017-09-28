<?php

class SessionModelValidatorTest extends \Codeception\Test\Unit
{
    private $modelValidator;

    // tests
    public function testSomeFeature()
    {
        $this->modelValidator = new Fileshare\Validators\SessionModelValidator;
        $this->accessLvl();
    }

    private function accessLvl()
    {
        $this->assertTrue(
            $this->modelValidator->validate([
                'propertyName' => 'accessLvl',
                'propertyValue' => 2
                ])
            );
    }
}
