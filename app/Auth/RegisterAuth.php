<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 9:11 PM
 */

namespace Fileshare\Auth;


class RegisterAuth
{
    private $loginValidator;
    private $passwordValidator;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->loginValidator = $this->container->get('LoginValidator');
        $this->passwordValidator = $this->container->get('PasswordValidator');
        $this->emailValidator = $this->container->get('EmailValidator');
        $this->nameValidator = $this->container->get('NameValidator');
    }

    public function auth($regFormData)
    {
        try {
            $this->loginValidator->validate($regFormData['login']);
            $this->passwordValidator->validate($regFormData['password']);
            $this->emailValidator->validate($regFormData['email']);
            $this->nameValidator->validate($regFormData['name']);
            //db query
        } catch (\InvalidArgumentException $e) {
            return false;
        }
    }
}