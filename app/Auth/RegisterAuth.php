<?php

namespace Fileshare\Auth;

use Fileshare\Exceptions\AuthorizeException as AuthorizeException;

class RegisterAuth extends AbstractAuth
{
    /**
     * @proerty \Fileshare\Db\ORM\Users
     */
    private $users;

    public function __construct($container)
    {
        parent::__construct($container);
        // $this->users = $container->get('Users');
    }

    public function auth($regFormData)
    {
        $this->emailIsFree($regFormData['email']);
        return true;
    }
    /**
     * @throws \Fileshare\Exceptions\AuthorizeExceptions
     */
    private function emailIsFree(string $email)
    {
        if (!empty($this->users::where('email', $email)->get()->all())) {
            throw new AuthorizeException("Another user registred with email ${email}");        
        }
    }
}
