<?php

declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\FileshareException as FileshareException;
use Fileshare\Exceptions\AuthorizeException as AuthorizeException;

class LoginMiddleware extends AbstractMiddleware
{
    use \Fileshare\Helpers\AuthorizeLogFormatHelperTrait;
    private $emailValidator;
    private $passwordValidator;
    private $loginAuth;
    /** @property array */
    private $loginData;

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
            $this->logger->authorizeLog($this->prepareSuccessAuthorizeLog());
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

    protected function userAlreadyAuthorized()
    {
        if ($this->sessionModel->authorizeStatus) {
            throw new FileshareException('Users already authorized with session id ' . session_id());
        }
    }
}
