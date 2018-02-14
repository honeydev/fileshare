<?php

namespace Fileshare\Validators;

class NameValidator extends AbstractValidator
{
    protected $regExpPattern = '/^([a-zа-я]|[0-9]| ){0,20}$/iu';

    public function validate($name)
    {
        if (!$this->dataIsMatchRegExp($this->regExpPattern, $name)) {
            throw new \Fileshare\Exceptions\ValidateException("Invalid login Value {$name}");
        }
        return true;
    }
}
