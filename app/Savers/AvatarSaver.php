<?php

declare(strict_types=1);

namespace Fileshare\Savers;

use Fileshare\Models\{File, Avatar};
use Fileshare\Models\FileInterface;
use \Slim\Http\UploadedFile;

class AvatarSaver implements SaversInterface
{

    private $uploadsMovementService;

    private $deleteFileService;

    public function __construct($container)
    {
        $this->uploadsMovementService = $container->get('UploadsMovementService');
        $this->deleteFileService = $container->get('DeleteFileService');
    }

    public function save(UploadedFile $uploadedFile, array $params = []): FileInterface
    {
        $owner = $params['owner'];
        $fileAttributes['ownerId'] = $owner->id;
        if (!empty($previousAvatar = Avatar::where('ownerId', $owner->id)->first())) {
            $previousAvatar->delete();
            $this->deleteFileService->delete($previousAvatar);
        }
        $avatarModelParams = $this->uploadsMovementService->movment($uploadedFile, $params);
        $avatarModelParams['ownerId'] = $owner->id;
        $avatar = new Avatar($avatarModelParams);
        $avatar->save();
        return $avatar;
    }
}
