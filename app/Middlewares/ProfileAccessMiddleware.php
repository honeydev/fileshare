<?php
/**
 * @class AuthMiddleware handle check user on access change profile
 */
declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Codeception\Util\Debug as debug;
use \Fileshare\Models\User;
use \Fileshare\Exceptions\InvalidRequestArgumentException;
use \Fileshare\Exceptions\AuthException;

class ProfileAccessMiddleware extends AbstractMiddleware
{
    /**
     * \Fileshare\Auth\ProfileAuth
     */
    private $profileAuth;
    protected $logger;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->profileAuth = $container->get('ProfileAuth');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $requestBody = $request->getParsedBody();
        try {
            $user = User::find($requestBody['id']);
            $this->profileAuth->auth(["user" => $user, 'targetProfileId' => $requestBody["targetProfileId"]]);
            $this->logger->accessLog("User with id: {$user->id} successfull access to change profile id: {$requestBody["targetProfileId"]}");
        } catch (AuthException $e) {
            $this->logger->accessLog("User can\\'t access to profile change - profile id: {$requestBody["targetProfileId"]}");
            return $this->sendErrorWithJson([
                'status' => 'faield',
                'errorType' => 'permission_denied',
                'exception' => $e,
                'errorCode' => 403
            ], $response);
        }
        $response = $next($request, $response);
        return $response;
    }
}
