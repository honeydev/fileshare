<?php

declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\FileshareException as FileshareException;
use Fileshare\Exceptions\AuthorizeException as AuthorizeException;

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
            $request = $request->withAttribute('loginData', $this->loginAuth->auth($loginData));
            $response = $next($request, $response);
            return $response;
        } catch (FileshareException $e) {
            $response = $this->sendErrorWithJson([
                'loginStatus' => 'failed',
                'errorType' => 'invalid_data',
                'exception' => $e,
                'errorCode' => 401
            ], $response); 
            return $response; 
        } catch (AuthorizeException $e) {
            $response = $this->sendErrorWithJson([
                'loginStatus' => 'failed',
                'errorType' => 'user_not_exist',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
            return $response;
        }
    }
}
