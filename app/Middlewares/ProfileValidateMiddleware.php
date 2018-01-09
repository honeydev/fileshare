<?php
/**
 * Created by PhpStorm.
 * User: lebedev
 * Date: 10/4/17
 * Time: 9:17 PM
 */

namespace Fileshare\Middlewares;

use Fileshare\Exceptions\FileshareException as FileshareException;

abstract class ProfileVadlidateMiddleware extends AbstractMiddleware
{
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
            $profileData = $request->getParsedBody();
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
                'errorType' => 'invalid_registration_data',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
            return $response;
        }
    }
}
