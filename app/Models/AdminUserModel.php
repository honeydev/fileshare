<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 18/11/17
 * Time: 14:35
 */
declare(strict_types=1);

namespace Fileshare\Models;

class AdminUserModel extends RegularUserModel implements UserInterface
{
    protected $privileges = [
        'see_open_notes' => true,
        'add_notes' => true,
        'edit_self_notes' => true,
        'see_all_notes' => true,
        'admin_privileges' => [
            'delete_any_note' => true,
            'edit_any_note' => true,
            'ban_users' => true
        ]
    ];
}