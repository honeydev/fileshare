<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 18/11/17
 * Time: 14:33
 */
declare(strict_types=1);

namespace Fileshare\Models;

class RegularUserModel extends \Fileshare\Models\AbstractUserModel
{
    protected $privileges = [
        'see_open_notes' => true,
        'add_notes' => true,
        'edit_self_notes' => true,
        'see_all_notes' => true,
    ];
}