<?php

declare(strict_types=1);

namespace Fileshare\Models;

use Illuminate\Database\Eloquent\Model as Model;

class FileToken extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function getToken()
    {
        $token = $this->token;
        $this->delete();
        return $token;
    }
}
