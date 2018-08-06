<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['email', 'password', 'token'];
    protected $hidden = [];

    public function userInfo()
    {
        return $this->hasOne(\Fileshare\Models\UserInfo::class, 'userId');
    }

    public function userSettings()
    {
        return $this->hasOne(\Fileshare\Models\UserSettings::class, 'userId');
    }

    public function avatar()
    {
        return $this->hasOne(\Fileshare\Models\Avatar::class, 'ownerId', 'id');
    }

    public static function getUserById(int $id): User
    {
        if (empty($user = User::find($id))) {
            throw new \Fileshare\Exceptions\DatabaseException("User with id {$id} not found in database");
        }
        return $user;
    }

    public static function getUserByEmail(string $email): User
    {
        if (empty($user = User::where("email", $email)->first())) {
            throw new \Fileshare\Exceptions\DatabaseException("User with email {$email} not found in database");
        }
        return $user;
    }
}
