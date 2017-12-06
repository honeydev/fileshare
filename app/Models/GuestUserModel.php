<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 18/11/17
 * Time: 14:28
 */
declare(strict_types=1);

namespace Fileshare\Models;

class GuestUserModel extends AbstractUserModel
{
    protected $name = 'guest';
    protected $privileges = [
        'see_open_notes' => true,
        'add_notes' => true,
        'edit_self_notes' => false,
        'see_all_notes' => true
    ];
}
