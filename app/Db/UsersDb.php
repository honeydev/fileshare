<?php

/** @class UsersDb realize access to users notes in database */

declare(strict_types=1);

namespace Fileshare\Db;

class UsersDb
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}
