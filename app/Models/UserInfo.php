<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;

class UserInfo extends Model
{
    protected $table = 'users_info';
    protected $fillable = ['name', 'avatar_uri', 'user_id'];
    protected $hidden = [];
    public $timestamps = false;
}
