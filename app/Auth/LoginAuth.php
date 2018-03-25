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
    /** @property \Filehsare\Db\ORM\User */
    private $user;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->user = $container->get('Users');
        $this->cryptoService = $container->get('CryptoService');
    }

    public function auth($loginFormData)
    {
        $userData = $this->userCanBeAuthorized($loginFormData);
        return $userData;
    }

    private function userCanBeAuthorized($loginFormData)
    {
        $this->checkEmailOnExist($loginFormData['email']);
        $this->cryptoService->passwordVerify(
            $loginFormData['password'],
            $targetUserData['hash']
        );
        return $targetUserData;
    }
    /**
     * @throws \Fileshare\Exceptions\AuthorizeException
     */
    private function checkEmailOnExist(string $email)
    {
        if (is_null($this->users::where('email', $email)->first())) {
            throw new AuthorizeException('Users with this email not registred');
        }
    }
}
