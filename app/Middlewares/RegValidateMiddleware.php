<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 29/10/17
 * Time: 17:45
 */

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\FileshareException as FileshareException;

class RegValidateMiddleware extends AbstractMiddleware
{
    private $emailValidator;
    private $passwordValidator;
    private $nameValidator;
    private $registrationAuth;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->emailValidator = $container->get('EmailValidator');
        $this->passwordValidator = $container->get('PasswordValidator');
        $this->nameValidator = $container->get('NameValidator');
        $this->registrationAuth = $container->get('RegisterAuth');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        try {
            $registrationData = $request->getParsedBody();
            $this->emailValidator->validate($registrationData['email']);
            $this->passwordValidator->validate($registrationData['password']);
            $this->passwordValidator->validate($registrationData['passwordRepeat']);
            $this->nameValidator->validate($registrationData['name']);
            $request = $request->withAttribute('regData', $registrationData);
            $response = $next($request, $response);
            return $response;
        } catch (FileshareException $e) {
            $response = $this->sendErrorWithJson([
                'regStatus' => 'faield',
                'errorType' => 'Invalid registration data',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
            return $response;
        }
    }
}
