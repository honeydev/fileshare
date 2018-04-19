<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;

class UserSettings extends Model
{
    protected $table = 'users_settings';
    public $timestamps = false;
    protected $fillable = ['account_status', 'access_lvl', 'user_id'];
    protected $hidden = [];
}
