<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 9:11 PM
 */

namespace Fileshare\Auth;

use Fileshare\Exceptions\AuthorizeException as AuthorizeException;

class RegisterAuth extends AbstractAuth
{
    use \Fileshare\CRUDs\UsersCRUDs;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->db = $container->get('db');
    }

    public function auth($regFormData)
    {
        $this->emailIsFree($regFormData['email']);
        return true;
    }

    private function emailIsFree($email)
    {
        if ($this->findEqualUserEmail($email) === false) {
            return true;
        }
        throw new AuthorizeException("Another user registred with email ${email}");
    }
}