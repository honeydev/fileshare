<?php

declare(strict_types=1);

namespace Fileshare\Db\ORM;

use Illuminate\Database\Eloquent\Model as Model;

class UsersSettings extends Model
{
    protected $table = 'users_settings';
    public $timestamps = false;
    protected $fillable = ['account_status', 'access_lvl', 'user_id'];
}
