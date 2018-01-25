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
    /** @param string */
    private $loginData;
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
            $this->loginData = $request->getParsedBody();
            $this->emailValidator->validate($this->loginData['email']);
            $this->passwordValidator->validate($this->loginData['password']);
            $this->userAlreadyAuthorized();
            $request = $request->withAttribute('loginData', $this->loginAuth->auth($this->loginData));
            $response = $next($request, $response);
            return $response;
        } catch (FileshareException $e) {
            $this->logger->authorizeLog($this->prepareFailedAuthorizeLog($e));
            return $this->sendErrorWithJson([
                'loginStatus' => 'failed',
                'errorType' => 'invalid_data',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
        } catch (AuthorizeException $e) {
            $this->logger->authorizeLog($this->prepareFailedAuthorizeLog($e));
            return $this->sendErrorWithJson([
                'loginStatus' => 'failed',
                'errorType' => 'user_not_exist',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
        }
    }

    private function prepareFailedAuthorizeLog(\Exception $e): string
    {
        $request = $this->container->get('request');
        $logMessage = '';
        $logMessage .= `Failed request on authorize account ` . $this->loginData['email'];
        $logMessage .= ' from ip address' . $request->getServerParam('REMOTE_ADDR');
        $logMessage .= $this->prepareErrorHelper->prepareErrorAsString($e);
        return $logMessage;
    }
}
