<?php

declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class RegUserTypeMiddleware extends AbstractMiddleware
{
    private $userTypeValidator;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->userTypeValidator = $container->get('UserTypeValidator');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        try {
            $regData = $request->getAttribute('regData');
            $this->userTypeValidator->validate($regData['accessLvl']);
            $this->checkUserType($regData['accessLvl']);
            $request = $request->withAttribute('regData', $regData);
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
        } catch (\InvalidArgumentException $e) {
            $response = $this->sendErrorWithJson([
                'regStatus' => "failed",
                'errorType' => 'invalid_registration_data',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
            return $response;
        }
    }

    private function checkUserType($requestedUserType)
    {
        if ($requestedUserType <= 1 || $this->sessionModel->accessLvl === 2) {
            return true;
        }
        throw new \InvalidArgumentException("Invalid user type {$requestedUserType}");
    }
}
