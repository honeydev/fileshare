<?php

namespace Fileshare\Db\Helpres;

use Illuminate\Support\Facades\DB as DB;

class UsersHelper
{
    public static function getAllUserData(string $id): array
    {
        $userInfo = DB::select(
            "users.email",
            "users_info.name",
            "users_settings.access_lvl",
            "users_settings.account_status"
        )->leftJoin(
            'users_info',
            'users.id',
            '=',
            'users_info.user_id'
        )->leftJoin(
            'users_settings',
            'users.id',
            '=',
            'users_info.user_id'
        )
        ->get()
        ->toArray();

        return $userInfo;
    }
}
