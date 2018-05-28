<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;

class UserSettings extends Model
{
    protected $table = 'users_settings';
    protected $fillable = ['accountStatus', 'accessLvl', 'userId'];
    protected $hidden = [];
}
