<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 10:46 PM
 */

namespace Fileshare\Validators;

use \Fileshare\Exceptions\FileshareException as FileshareException;

class LoginValidator extends AbstractValidator
{
    protected $regExpPattern = '/^[a-z]{1}([a-z]|[0-9]|\.|_|-){0,20}$/i';

    public function validate($login)
    {
        if (!$this->dataIsMatchRegExp($this->regExpPattern, $login)) {
            throw new FileshareException("Invalid login Value {$login}");
        }
        return true;
    }
}