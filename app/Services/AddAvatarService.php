<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Codeception\Util\Debug as debug;
use \Fileshare\Models\{File, User, Avatar};

class AddAvatarService
{
    /**
     * @property \Fileshare\Services\DeleteFileService
     */
    private $deleteFileService;

    public function __construct($container)
    {
        $this->deleteFileService = $container->get("DeleteFileService");
    }

    public function add(File $file, User $owner)
    {
        if (!empty($oldAvatar = Avatar::where("ownerId", $owner->id)->first())) {
            $this->deleteFileService->delete($oldAvatar->file);
            Avatar::where('parentId', '=', $oldAvatar->parentId)->delete();
        }

        $avatar = Avatar::create(["parentId" => $file->id, "ownerId" => $owner->id]);
        $avatar->save();
        return $avatar;
    }
}
