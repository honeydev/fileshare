<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 9:18 PM
 */

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\FileshareException as FileshareException;

class LoginMiddleware extends AbstractMiddleware
{
    private $emailValidator;
    private $passwordValidator;
    private $loginAuth;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->emailValidator = $container->get('EmailValidator');
        $this->passwordValidator = $container->get('PasswordValidator');
        $this->loginAuth = $container->get('LoginAuth');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        try {
            $loginData = $request->getParsedBody();
            $this->emailValidator->validate($loginData['email']);
            $this->passwordValidator->validate($loginData['password']);
            $this->userAlreadyAuthorized();
            $this->loginAuth->auth($loginData);
            $response = $next($request, $response);
        } catch (FileshareException $e) {
            $error = $this->prepareErrorToJsonSend($e, 'Invalid login data');
            $response = $response->withJson($error, 401);
        }
        return $response;
    }
}