<?php
/**
 * @class OwnerMiddleware check equal user id and user id in base.
 * if user category > 1, it is equal to the owner
 */
declare(strict_types=1);

namespace Fileshare\Middlewares;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class OwnerMiddleware extends AbstractMiddleware
{
    use \Fileshare\Helpers\OwnerMiddlewareLogHelperTrait;
    /** @property string */
    private $id;

    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        try {
            $this->id = $request->getParsedBody()['id'];
            $this->userCanChangeData();
            $response = $next($request, $response);
            return $response;
        } catch (\Fileshare\Exceptions\AccessException $e) {
            $this->logger->noticeLog($this->prepareFailedProfileChange($e));
            return $this->sendErrorWithJson([
                'loginStatus' => 'failed',
                'errorType' => 'user_cant_change_this_profile',
                'exception' => $e,
                'errorCode' => 401
            ], $response);
        }
    }
    /**
     * @throws \Fileshare\Exceptions\AccessException
     */
    private function userCanChangeData()
    {
        if (!$this->userIsOwner() && !$this->userIsAdmin()) {
            throw new \Fileshare\Exceptions\AccessException('User can\'t change this matherial');
        }
    }

    private function userIsOwner(): bool
    {
        return $this->id === $this->sessionModel->user->id;
    }

    private function userIsAdmin(): bool
    {
        return $this->sessionModel->accessLvl > 1;
    }
}
