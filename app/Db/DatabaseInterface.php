<?php

/** @interface DatabaseInterface */

declare(strict_types=1);

namespace Fileshare\Db;

interface DatabaseInterface
{
    public function query(string $query): bool;
}
