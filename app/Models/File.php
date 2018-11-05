<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Builder;

class File extends Model implements FileInterface
{
    protected $guarded = [];

    public function owner()
    {
        return $this->hasOne(\Fileshare\Models\User::class, 'id', 'ownerId');
    }

    public static function getFileByName(string $name): File
    {
        if (empty($file = File::where("name", $name)->first())) {
            throw new \InvalidArgumentException("File with name {$name} not found");
        }

        return $file;
    }

    public static function selectAllWithoutAvatars(): Builder
    {
        return File::raw('SELECT * FROM files WHERE id NOT IN (SELECT parentId FROM avatars)');
    }
}
