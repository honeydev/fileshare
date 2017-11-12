<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 07/11/17
 * Time: 21:47
 */

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Exceptions\DatabaseException;
use Fileshare\Exceptions\FileshareException;

class AddUserService
{
    use \Fileshare\CRUDs\UsersCRUDs;

    private $cryptoService;

    public function __construct($container)
    {
        $this->db = $container->get('db');
        $this->cryptoService = $container->get('CryptoService');
    }

    public function addUser($userData)
    {
        try {
            extract($userData); //expect vars $email, $password, $name
            $userData['hash'] = $this->cryptoService->getPasswordHash($password);
            var_dump($this->addUserInUsers($userData));
        } catch (FileshareException $e) {

        } catch (DatabaseException $e ) {

        }
    }

    private function addUserInBase($userData)
    {

    }
}