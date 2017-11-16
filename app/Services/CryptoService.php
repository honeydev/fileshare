<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 07/11/17
 * Time: 21:47
 */

namespace Fileshare\Services;

use Fileshare\Exceptions\FileshareException as FileshareException;

class CryptoService
{
    public function getPasswordHash($password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($hash !== false) {
            return $hash;
        }
        throw new FileshareException('Password hash generate failed');
    }

    public function passwordVerify($inputPassword, $targetHash)
    {
        if (password_verify($inputPassword, $targetHash)) {
            return true;
        }
        throw new FileshareException('Invalid password');
    }
}
