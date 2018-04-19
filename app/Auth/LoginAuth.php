<?php

declare(strict_types=1);

namespace Fileshare\Auth;

use Fileshare\Exceptions\AuthorizeException as AuthorizeException;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class LoginAuth extends AbstractAuth
{
    public function __construct($container)
    {
        parent::__construct($container);
    }
    /**
     * @throws AuthorizeException
     */
    public function auth($loginData)
    {
        if (!$this->userExist($loginData['email'])) {
            throw new AuthorizeException("User with email {$loginData['email']} not found");
        }

        $user = EloquentModel::where('email', $email)->first();

        if (!$this->passwordHashCorrect($user, $loginData['password'])) {
            throw new AuthorizeException("Invalid password {$loginData['password']}");
        }
    }
}
