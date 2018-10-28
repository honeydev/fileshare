<?php

declare(strict_types=1);

namespace Fileshare\Searchers;

use Illuminate\Database\Eloquent\Builder;

interface SearcherInterface
{
    public function search(string $keyString): Builder;
}
