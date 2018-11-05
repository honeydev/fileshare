<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Fileshare\Exceptions\DatabaseException;
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
        $avatar = $this->hasOne(\Fileshare\Models\Avatar::class, 'ownerId')->first();
        if (!empty($avatar)) {
            return $avatar;
        }
        //if user does not have avatar, return anonymous user avatar
        $anonymous = self::getUserByEmail('anonymous@fileshare');
        if (empty($anonymous)) {
            throw DatabaseException('Not found anonymous avatar in db');
        }
        return $anonymous->avatar()->first();
    }

    public static function getUserById(int $id): User
    {
        if (empty($user = User::find($id))) {
            throw new DatabaseException("User with id {$id} not found in database");
        }
        return $user;
    }

    public static function getUserByEmail(string $email): User
    {
        if (empty($user = User::where("email", $email)->first())) {
            throw new DatabaseException("User with email {$email} not found in database");
        }
        return $user;
    }
}
