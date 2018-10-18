<?php

declare(strict_types=1);

namespace Fileshare\Searchers;

use Illuminate\Database\Eloquent\Collection;

interface SearcherInterface
{
    public function search(string $keyString): array;
}
