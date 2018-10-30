<?php

declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\AuthException as AuthException;

class LoginAuthMiddleware extends AbstractMiddleware
{
    use \Fileshare\Helpers\AuthorizeLogFormatHelperTrait;
    /**
     * @property Fileshare\Validators\EmailValidator
     */
    private $emailValidator;
    /**
     * @property Fileshare\Validators\PasswordValidator
     */
    private $passwordValidator;
    /**
     * @property Fileshare\Auth\LoginAuth
     */
    private $loginAuth;
    /**
     * @property array
     */
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
            $this->loginData = $request->getAttribute('loginData');
            $this->loginAuth->auth($this->loginData);
            $response = $next($request, $response);
            return $response;
        } catch (AuthException $e) {
            $this->logger->authorizeLog($this->prepareFailedAuthorizeLog($e));
            return $this->sendErrorWithJson([
                'loginStatus' => 'failed',
                'errorType' => 'invalid_login_data',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
        }
    }
}
