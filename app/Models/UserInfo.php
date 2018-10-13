<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;

class UserInfo extends Model
{
    protected $primaryKey = 'userId';
    protected $table = 'users_info';
    protected $fillable = ['name', 'avatarUri', 'userId'];
    protected $hidden = [];
}
