<?php

declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\FileshareException as FileshareException;
use Fileshare\Exceptions\AuthorizeException as AuthorizeException;

class LoginAuthMiddleware extends AbstractMiddleware
{
    use \Fileshare\Helpers\AuthorizeLogFormatHelperTrait;

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
            $this->loginAuth->auth($request->getAttribute('loginData'));
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
}
