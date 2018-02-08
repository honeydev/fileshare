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
    /** @property \Fileshare\Db\models\User */
    private $dbUser;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->dbUser = $container->get('User');
    }

    public function auth($regFormData)
    {
        $this->emailIsFree($regFormData['email']);
        return true;
    }

    private function emailIsFree($email)
    {
        if ($this->dbUser->findEqualUserEmail($email) === false) {
            return true;
        }
        throw new AuthorizeException("Another user registred with email ${email}");
    }
}
