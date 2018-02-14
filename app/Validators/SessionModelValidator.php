<?php


namespace Fileshare\Validators;

class SessionModelValidator extends AbstractValidator
{
    protected $regExpPattern = [
        'authorizeStatus' => '/^|1$/',
        'accessLvl' => '/^[0-3]{1}$/',
        'ip' => '/^(([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.){3}([0-1]?[0-9]?[0-9]|2[0-5][0-5])$/',
        'user' => null // user is object not check for regexp
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
                Invalid session property key [{$key}]
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
        if (is_object($propertyValue)) {
            return true;
        }

        if (!$this->dataIsMatchRegExp($pattern, $propertyValue)) {
            throw new \Fileshare\Exceptions\ValidateException("
                Incorrect  value [{$propertyValue}]
                not match [{$pattern}]
            ");
        }
    }
}
