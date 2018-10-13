<?php

declare(strict_types=1);

namespace Fileshare\Auth;

use Fileshare\Exceptions\AuthException;
use Fileshare\Models\User;
use \Codeception\Util\Debug as debug;

class LoginAuth extends AbstractAuth
{
    /**
     * @throws AuthException
     */
    public function auth($loginData)
    {
        if (!$this->userExist($loginData['email'])) {
            throw new AuthException("User with email {$loginData['email']} not found");
        }
        $email = $loginData['email'];
        $user = \Fileshare\Models\User::where('email', $email)->first();

        if (!$this->passwordHashCorrect($user, $loginData['password'])) {
            throw new AuthException("Invalid password {$loginData['password']}");
        }
    }
}
