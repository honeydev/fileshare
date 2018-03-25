<?php

declare(strict_types=1);

namespace Fileshare\Models;

class RegularUserModel extends AbstractUserModel implements UserInterface
{
    /** @property string */
    protected $email;
    /** @property string */
    protected $name;
    /** @property string */
    protected $avatarUri;
    /** @property string */
    protected $id;
    /** @property array */
    protected $privileges = [
        'see_open_notes' => true,
        'add_notes' => true,
        'edit_self_notes' => true,
        'see_all_notes' => true,
    ];
}
