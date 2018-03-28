<?php

declare(strict_types=1);

namespace Fileshare\Db\ORM;

use Illuminate\Database\Eloquent\Model as Model;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = ['email', 'hash'];
    protected $hidden = ['hash'];
    public $timestamps = false;

    public function usersInfo()
    {
        return $this->hasOne('Fileshare\Db\ORM\UsersInfo', 'user_id');
    }

    public function usersSettings()
    {
        return $this->hasOne('Fileshare\Db\Orm\UsersSettings', 'user_id');
    }
}
