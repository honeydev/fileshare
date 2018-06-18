<?php

namespace Fileshare\Auth;

use Fileshare\Exceptions\AuthException;

class RegisterAuth extends AbstractAuth
{
    public function auth($regFormData)
    {
        $this->emailIsFree($regFormData['email']);
        return true;
    }
    /**
     * @throws \Fileshare\Exceptions\AuthException
     */
    private function emailIsFree(string $email)
    {
        if (!empty($this->users::where('email', $email)->get()->all())) {
            throw new AuthException("Another user registred with email ${email}");        
        }
    }
}
