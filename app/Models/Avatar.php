<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Fileshare\Services\DeleteFileService;

class Avatar extends Model implements FileInterface
{
    public $timestamps = false;
    protected $guarded = [""];

    public function file()
    {
        return $this->hasOne(\Fileshare\Models\File::class, 'id', 'parentId');
    }
}
