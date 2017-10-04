<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 8:36 PM
 */

namespace Fileshare\Auth;

use Fileshare\Exceptions\FileshareException as FileshareException;

class LoginAuth extends AbstractAuth
{
    private $loginValidator;
    private $passwordValidator;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->loginValidator = $this->container->get('LoginValidator');
        $this->passwordValidator = $this->container->get('PasswordValidator');
    }

    public function auth($loginFormData)
    {
        try {
            $this->loginValidator->validate($loginFormData['login']);
            $this->passwordValidator->validate($loginFormData['password']);
            //db query
        } catch (FileshareException $e) {
            $this->logger->error($e->getErrorMessage());
            return false;
        }
        return true;
    }
}