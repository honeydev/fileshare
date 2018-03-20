<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;

abstract class AbstractUserModel extends Model
{
    protected $table = 'users';
    public $timestamps = false;
}
