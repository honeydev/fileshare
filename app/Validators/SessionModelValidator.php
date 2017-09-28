<?php


namespace Fileshare\Validators;

class SessionModelValidator extends AbstractValidator
{
    protected $regExpPattern = [
        'authorizeStatus' => '/^0|1$/',
        'accessLvl' => '/^[0-3]{1}$/',
        'ip' => '/^([0-255]\.){3}([0-255]{1})$/'
    ];

    public function validate($dataFromValidate)
    {
        $key = $dataFromValidate['propertyName'];
        $propertyValue = $dataFromValidate['propertyValue'];
        $this->checkPropertyName($key);
        $pattern = $this->regExpPattern[$key];
        $this->checkPropertyValue($pattern, $propertyValue);

        return true;
    }

    private function checkPropertyName($key)
    {
        if (!$this->keyValid($key)) {
            throw new \UnexpectedValueException("
                Invalid session property key {$dataFromValidate['propertyName']}
                ");
        }       
    }

    private function keyValid($key) 
    {
        if (array_key_exists($key, $this->regExpPattern)) {
            return true;
        }
        return false;
    }

    private function checkPropertyValue($pattern, $propertyValue)
    {
        if (!$this->dataIsMatchRegExp($pattern, $propertyValue)) {
            throw new \Exception("
                Incorrect  value [{$propertyValue}]
                not match [{$pattern}]
            ");
        }
    }
}
