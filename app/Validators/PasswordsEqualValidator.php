<?php
/**
 * @class Passwords EqualValidtor
 */
declare(strict_types=1);

namespace Fileshare\Validators;

class PasswordsEqualValidator extends AbstractValidator
{
    /**
     * @param $passwords array with keys "password", "passwordRepeat"
     */
    public  function validate($passwords)
    {
        $this->checkToEqual($passwords);
    }

    private function checkToEqual(array $passwords): bool
    {
        if ($passwords['password'] === $passwords['passwordRepeat']) {
            return true;
        }
        throw new \Fileshare\Exceptions\ValidateException(
            "Password {$passwords["password"]} and password repeat {$passwords["passwordRepeat"]} not equal"
        );
    }
}
