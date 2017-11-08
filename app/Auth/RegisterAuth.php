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
            //$this->emailIsFree($regFormData['email']);
        } catch (\PDOException $e) {
           echo 'pdo except';
           throw new DatabaseException($e->getMessage());
        }
    }

    private function emailIsFree($email)
    {
        if ($this->findEqualUserEmail($email) === false) {
            return true;
        }
        throw new DatabaseException(
            "Another user registred with email ${email}"
            );
    }
}