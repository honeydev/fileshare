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
            
            echo 'login mw';
            $loginData = $request->getParsedBody();
            $this->emailValidator->validate($loginData['email']);
            $this->passwordValidator->validate($loginData['password']);
            $this->userAlreadyAuthorized();
            $request = $request->withAttribute('loginData', $this->loginAuth->auth($loginData));
            $response = $next($request, $response);
            echo 'end mw';
        } catch (FileshareException $e) {
            echo 'error';
            $response = $this->sendErrorWithJson([
                'errorType' => 'Invalid login data',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
        } catch (AuthorizeException $e) {
            $response = $this->sendErrorWithJson([
                'errorType' => 'User not exist',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
        } finally {
            return $response;
        }
    }
}