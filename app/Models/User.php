<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['email', 'password', 'token'];
    protected $hidden = [];
    public $timestamps = true;

    public function userInfo()
    {
        return $this->hasOne(\Fileshare\Models\UserInfo::class, 'user_id');
    }

    public function userSettings()
    {
        return $this->hasOne(\Fileshare\Models\UserSettings::class, 'user_id');
    }
}
