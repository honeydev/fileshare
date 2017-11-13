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
    use \Fileshare\CRUDs\UsersCRUDs;

    private $cryptoService;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->db = $container->get('db');
        $this->cryptoService = $container->get('CryptoService');
    }

    public function auth($loginFormData)
    {
        try {
            $this->userCanBeAuthorized($loginFormData);
            echo 'user exist psw correct';
        } catch (FileshareException $e) {
            $this->logger->error($e->getErrorMessage());
            return false;
        }
        return true;
    }

    private function userCanBeAuthorized($loginFormData)
    {
        $targetUserData = $this->selectUserData(
            [
                'identificatorType' => 'email',
                'identificatorValue' => $loginFormData['email']
            ]
        );
        $this->existUserWithThisEmail($targetUserData);
        $this->hashsEqual(
            $loginFormData['password'], 
            $targetUserData['hash']
            );
    }

    private function existUserWithThisEmail($targetUserData)
    {
        if (!empty($targetUserData)) {
            return true;
        }
        throw new FileshareException(
            'User with this email not registred'
        );
    }

    private function hashsEqual($inputPassword, $targetHash)
    {
        if (password_verify($inputPassword, $targetHash)) {
            return true;
        }
        throw new FileshareException('Invalid password');
    }
}
