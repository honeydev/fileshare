<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Avatar extends Model
{
    protected $guarded = [""];
    public $timestamps = false;

    public function file()
    {
        return $this->hasOne(\Fileshare\Models\File::class, 'id', 'parentId');
    }
}
