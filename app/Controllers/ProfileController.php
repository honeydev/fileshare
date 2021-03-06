<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\{User, Avatar};
use \Fileshare\Exceptions\DatabaseException;
use \Fileshare\Transformers\UserTransformer;
use \Codeception\Util\Debug as debug;

class ProfileController extends AbstractController
{
    /**
     * @property \Fileshare\Services\UpdateUserService
     */
    private $updateUserService;
    /**
     * @property \Fileshare\Services\FileSaveService
     */
     private $fileSaveService;
    /**
     * @property \Fileshare\Helpers\PrepareErrorHelper
     */
    private $prepareErrorHelper;
    /**
     * @property \Fileshare\Savers\AvatarSaver
     */
    private $avatarSaver;
    /**
     * @property \Fileshare\Components\Logger
     */

    private $logger;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->updateUserService = $this->container->get("UpdateUserService");
        $this->fileSaveService = $container->get('FileSaveService');
        $this->prepareErrorHelper = $this->container->get("PrepareErrorHelper");
        $this->logger = $container->get('Logger');
        $this->avatarSaver = $this->container->get('AvatarSaver');
    }

    public function changeProfile(Request $request, Response $response)
    {
        $requestData = $request->getParsedBody();
        $userRequester = $request->getAttribute("userRequester");
        $targetUserId = $requestData["targetProfileId"];
        $targetUser = User::find($targetUserId);
        $this->updateUserService->update(
            $targetUser,
            $requestData
        );
        $this->logger->accessLog("User {$userRequester->id} change profile with id {$targetUser->id}");
        $responseUserData = UserTransformer::transform($targetUser);
        return $response->withJson(['status' => 'success', 'user' => $responseUserData], 200);
    }

    public function uploadAvatar(Request $request, Response $response)
    {
        $avatarFile = $request->getUploadedFiles()["file"];
        $jwt = $request->getAttribute("token");
        $owner = User::getUserById($jwt->sub);
        try {
            $avatar = $this->avatarSaver->save($avatarFile, [
                'owner' => $owner,
                'category' => 'avatars'
            ]);
        } catch (\Fileshare\Exceptions\IOException $e) {
            $this->logger->errorLog($e->getMessage());
            $error = $this->prepareErrorHelper->prepareErrorAsArray($e, "io_error");
            return $response->withJson($error, 500);
        } catch (DatabaseException $e) {
            $this->logger->errorLog($e->getMessage());
            $error = $this->prepareErrorHelper->prepareErrorAsArray($e, "db_error");
            return $response->withJson($error, 401);
        }
        return $response->withJson(["status" => "success", "avatar" => $avatar->toArray()], 200);
    }
}
