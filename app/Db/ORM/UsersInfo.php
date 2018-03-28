<?php

declare(strict_types=1);

namespace Fileshare\Db\ORM;

use Illuminate\Database\Eloquent\Model as Model;

class UsersInfo extends Model
{
    protected $table = 'users_info';
    protected $fillable = ['name', 'avatar_uri'];
    protected $hidden = ['user_id'];
    public $timestamps = false;
}
