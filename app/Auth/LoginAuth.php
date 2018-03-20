<?php
/**
 * Created by PhpStorm.
 * Users: lebedev
 * Date: 10/4/17
 * Time: 8:36 PM
 */
namespace Fileshare\Auth;

use Fileshare\Exceptions\AuthorizeException as AuthorizeException;

class LoginAuth extends AbstractAuth
{
    private $cryptoService;
    /** @property \Fileshare\Db\models\Users */
    private $dbUser;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->dbUser = $container->get('Users');
        $this->cryptoService = $container->get('CryptoService');
    }

    public function auth($loginFormData)
    {
        $userData = $this->userCanBeAuthorized($loginFormData);
        return $userData;
    }

    private function userCanBeAuthorized($loginFormData)
    {
        $targetUserData = $this->dbUser->selectUserData(
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
        throw new AuthorizeException('Users with this email not registred');
    }
}
