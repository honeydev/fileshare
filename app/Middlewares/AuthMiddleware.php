<?php
/**
 * @class AuthMiddleware request request of the authenticity
 */
declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Codeception\Util\Debug as debug;
use \Fileshare\Models\User;
use \Fileshare\Exceptions\InvalidRequestArgumentException;
use \Fileshare\Exceptions\AuthException;

class AuthMiddleware extends AbstractMiddleware
{
    private $acl;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->acl = $container->get('ACL');
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $requestBody = $request->getParsedBody();
        try {
            if (!array_key_exists('token', $requestBody)) {
                throw new InvalidRequestArgumentException("Not found request argument 'token'");
            }

            if (!array_key_exists('id', $requestBody)) {
                throw new InvalidRequestArgumentException("Not found request Argument 'id'");
            }

            $requestUser = User::find($requestBody['id']);

            if ($requestUser->token !== $requestBody["token"]) {
                throw new AuthException("Invalid request token {$requestBody['token']}");
            }
        } catch (InvalidRequestArgumentException $e)  {
            return $this->sendErrorWithJson([
                'status' => 'faield',
                'errorType' => 'request_not_contain_auth_info',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
        } catch (AuthException $e) {
            return $this->sendErrorWithJson([
                'status' => 'faield',
                'errorType' => 'invalid_request_token',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
        }
        $response = $next($request, $response);
        return $response;
    }
}
