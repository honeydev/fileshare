<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Avatar extends Model
{
    public function file()
    {
        return $this->hasOne(\Fileshare\Models\UserSettings::class, 'foreign_key');
    }
}
