<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Fileshare\Services\DeleteFileService;

class Avatar extends Model
{
    public $timestamps = false;
    protected $guarded = [""];

    public function file()
    {
        return $this->hasOne(\Fileshare\Models\File::class, 'id', 'parentId');
    }

    public static function createNewAvatar(File $file, User $owner): Avatar
    {
        if (!empty($oldAvatar = Avatar::where("ownerId", $owner->id)->first())) {
            $oldAvatarFile = File::find($oldAvatar->parentId);
            Avatar::where('parentId', '=', $oldAvatar->parentId)->delete();
            $deleteService = new DeleteFileService();
            $deleteService->delete($oldAvatarFile);
            $oldAvatarFile->delete();
        }

        $avatar = Avatar::create(["parentId" => $file->id, "ownerId" => $owner->id]);
        $avatar->save();
        return $avatar;
    }
}
