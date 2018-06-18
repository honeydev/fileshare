<?php
/**
 * @class ProfileValidateMiddleware validate profile change request
 */
declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Fileshare\Exceptions\ValidateException as ValidateException;
use \Codeception\Util\Debug as debug;

class ProfileValidateMiddleware extends AbstractMiddleware
{
    /** @property \Fileshare\Validators\EmailValidator */
    private $emailValidator;
    /** @property \Fileshare\Validators\PasswordValidator */
    private $passwordValidator;
    /** @property \Fileshare\Validators\NameValidator */
    private $nameValidator;
    /** @property \Fileshare\Validators\PasswordEqualValidator */
    private $passwordEqualValidator;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->emailValidator = $container->get('EmailValidator');
        $this->passwordValidator = $container->get('PasswordValidator');
        $this->nameValidator = $container->get('NameValidator');
        $this->passwordEqualValidator = $container->get('PasswordEqualValidator');
        $this->container = $container;
    }
    
    public function __invoke(Request $request, Response $response, $next)
    {
        try {
            $profileData = $request->getParsedBody();
            $this->validate($profileData);
            $response = $next($request, $response);
            return $response;
        } catch (ValidateException $e) {
            $response = $this->sendErrorWithJson([
                'regStatus' => 'faield',
                'errorType' => 'invalid_new_profile_data',
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

        if (array_key_exists('name', $profileData)) {
            $this->nameValidator->validate($profileData['name']);
        }

        if (array_key_exists('password', $profileData) && array_key_exists('passwordRepeat', $profileData)) {
            $this->passwordValidator->validate($profileData['password']);
            $this->passwordValidator->validate($profileData['passwordRepeat']);
            $this->passwordEqualValidator->validate(
                array(
                    'password' => $profileData['password'],
                    'passwordRepeat' => $profileData['passwordRepeat']
                    )
                );
        } else if (array_key_exists('password', $profileData) XOR array_key_exists('passwordRepeat', $profileData)) {
            throw new ValidateException("Password or password repeat not inputed");
        }
    }
}
