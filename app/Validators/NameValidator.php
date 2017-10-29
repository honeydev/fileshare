<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 29/10/17
 * Time: 18:05
 */

namespace Fileshare\Validators;

class NameValidator extends AbstractValidator
{
    protected $regExpPattern = '/^([a-zа-я]|[0-9]| ){0,20}$/i';

    public function validate($name)
    {
        if (!$this->dataIsMatchRegExp($this->regExpPattern, $name)) {
            throw new FileshareException("Invalid login Value {$name}");
        }
        return true;
    }
}
