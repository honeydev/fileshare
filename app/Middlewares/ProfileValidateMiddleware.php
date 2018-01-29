<?php
/**
 * @class ProfileValidateMiddleware validate profile change request
 */
declare(strict_types=1);

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
            $this->validate($profileData);
            $request = $request->withAttribute('profileData', $profileData);
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

    private function validate(array $profileData)
    {
        if (array_key_exists('email', $profileData)) {
            $this->emailValidator->validate($profileData['email']);
        }
    }
}
