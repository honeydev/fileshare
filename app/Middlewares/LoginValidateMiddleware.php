<?php

declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\ValidateException as ValidateException;
use \Codeception\Util\Debug as debug;

class LoginValidateMiddleware extends AbstractMiddleware
{
    private $emailValidator;
    private $passwordValidator;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->emailValidator = $container->get('EmailValidator');
        $this->passwordValidator = $container->get('PasswordValidator');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        try {
            $this->loginData = $request->getParsedBody();
            $this->emailValidator->validate($this->loginData['email']);
            $this->passwordValidator->validate($this->loginData['password']);
            $request = $request->withAttribute('loginData', $registrationData);
            $response = $next($request, $response);
            return $response;
        } catch (ValidateException $e) {
            $response = $this->sendErrorWithJson([
                'regStatus' => 'faield',
                'errorType' => 'invalid_registration_data',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
            return $response;
        }
    }
}
