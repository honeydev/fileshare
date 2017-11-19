<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 19/11/17
 * Time: 16:19
 */

namespace Fileshare\Validators;

use Fileshare\Exceptions\FileshareException;

class UserTypeValidator extends AbstractValidator
{
    public function validate($userType)
    {
        if ($userType >= 0 && $userType <= 2) {
            return true;
        }
        throw new FileshareException("Invalid user type {$userType}");
    }
}
