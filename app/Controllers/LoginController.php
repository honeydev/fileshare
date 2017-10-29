<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 10/10/17
 * Time: 13:25
 */
namespace Fileshare\Controllers;


use Fileshare\Exceptions\FileshareException;

class LoginController extends AbstractController
{
    private $loginAuth;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->loginAuth = $container->get('LoginAuth');
    }

    public function loginForm($request, $response)
    {
        try {
            $this->loginAuth($request->getParsetBody());
            return $response;
        } catch (FileshareException $e) {

        }
    }
}
