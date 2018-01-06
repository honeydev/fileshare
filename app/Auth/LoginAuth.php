<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 8:36 PM
 */
namespace Fileshare\Auth;

use Fileshare\Exceptions\AuthorizeException as AuthorizeException;

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
        $userData = $this->userCanBeAuthorized($loginFormData);
        return $userData;
    }

    private function userCanBeAuthorized($loginFormData)
    {
        $targetUserData = $this->selectUserData(
            [
                'column' => 'email',
                'value' => $loginFormData['email']
            ]
        );
        $this->existUserWithThisEmail($targetUserData);
        $this->cryptoService->passwordVerify(
            $loginFormData['password'], 
            $targetUserData['hash']
            );
        return $targetUserData;
    }

    private function existUserWithThisEmail($targetUserData)
    {
        if (!empty($targetUserData) && $targetUserData !== false) {
            return true;
        }
        throw new AuthorizeException('User with this email not registred');
    }
}
