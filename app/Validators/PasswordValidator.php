<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/6/17
 * Time: 1:38 AM
 */

namespace Fileshare\Validators;

class PasswordValidator extends AbstractValidator
{
    protected $regExpPattern = '/^([a-z]|[0-9]|@|#|\$|%|\+|&|\*|\(|\)|!|~|@|\^|_|-|=){5,20}$/i';

    public function validate($password)
    {
        if (!$this->dataIsMatchRegExp($this->regExpPattern, $password)) {
            throw new \Fileshare\Exceptions\ValidateException("Invalid password Value {$password}");
        }
        return true;
    }
}
