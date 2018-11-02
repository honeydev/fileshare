<?php

declare(strict_types=1);

namespace Fileshare\Searchers;

use Illuminate\Database\Eloquent\Collection;
use Fileshare\Models\{File, Avatar};
use Fileshare\Packers\FilePacker;
use Fileshare\Helpers\SelectHelper;
use Illuminate\Database\Eloquent\Builder;

class FileSearcher implements SearcherInterface
{
    public function search(string $keyString): Builder
    {
        return File::where('name', 'like', "%{$keyString}%")
            ->whereNotIn('files.id', Avatar::select('parentId')->get())
            ->limit(100);
    }
}
