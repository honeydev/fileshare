<?php

declare(strict_types=1);

namespace Fileshare\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Fileshare\Models\User;
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
        $user = User::find($requestData['id']);
        $this->updateUserService->update(
            $user,
            $requestData
        );
        $this->logger->accessLog("User {$user->id} change profile");
        $responseUserData = UserTransformer::transform($user);
        return $response->withJson(['status' => 'success', 'user' => $responseUserData], 200);
    }

    public function uploadAvatar(Request $request, Response $response)
    {
        $avatar = $request->getUploadedFiles()['avatar'];
        try {
            $avatarToken = $this->fileSaveService->save($avatar, ["category" => "/avatars"]);
        } catch (\Fileshare\Exceptions\IOException $e) {
            $this->logger->errorLog("IOException avatar upload, avatar token {$avatarToken}");
            $error = array_merge(
                [
                    "status" => "failed",
                    "errorType" => "io_error"
                ],
                $this->prepareErrorHelper->prepareErrorAsArray($e)
            );
            return $response->withJson($error, 500);
        }
        $this->logger->accessLog("Upload avatar, avatar token {$avatarToken}");
        return $response->withJson(["status" => "success", "avatarToken" => $avatarToken]);
    }

    public function confirmAvatar(Request $request, Response $response)
    {

    }
}
