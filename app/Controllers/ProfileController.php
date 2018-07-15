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
     * @property \Fileshare\Service\CryptoService
     */
    private $cryptoService;
    /**
     * @property \Fileshare\Helpers\PrepareErrorHelper
     */
    private $prepareErrorHelper;

    private $logger;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->updateUserService = $this->container->get("UpdateUserService");
        $this->fileSaveService = $container->get('FileSaveService');
        $this->prepareErrorHelper = $this->container->get("PrepareErrorHelper");
        $this->logger = $container->get('Logger');
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
        $avatar = $request->getUploadedFiles()["avatar"];
        $jwt = $request->getAttribute("token");
        $owner = User::getUserById($jwt->sub);
        try {
            $file = $this->fileSaveService->save($avatar, [
                "owner" => $owner,
                "category" => "/avatars"
                ]
            );
            $avatar = Avatar::create(["parentId" => $file->id]);
            $avatar->save();
        } catch (\Fileshare\Exceptions\IOException $e) {
            $this->logger->errorLog($e->getMessage());
            $error = $this->prepareErrorHelper->prepareErrorAsArray($e, "io_error");
            return $response->withJson($error, 500);
        } catch (DatabaseException $e) {
            $this->logger->errorLog($e->getMessage());
            $error = $this->prepareErrorHelper->prepareErrorAsArray($e, "db_error");
            return $response->withJson($error, 401);
        }
        return $response->withJson(["status" => "success", "avatar" => $avatar->file->toArray()], 200);
    }
}
