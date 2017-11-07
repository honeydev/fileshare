<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 9:11 PM
 */

namespace Fileshare\Auth;

use Fileshare\Exceptions\DatabaseException as DatabaseException;
use Fileshare\Exceptions\FileshareException as FileshareException;

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
        try {
            $this->emailIsFree($regFormData['email']);
        } catch (DatabaseException $e) {
            throw new FileshareException($e->getMessage());
        }
    }

    private function emailIsFree($email)
    {
        if ($this->findEqualUserEmail($email)) {
            return true;
        }
        throw new DatabaseException(
            "Another user registred with email ${email}"
            );
    }
}