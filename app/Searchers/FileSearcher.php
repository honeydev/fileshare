<?php

declare(strict_types=1);

namespace Fileshare\Searchers;

use Illuminate\Database\Eloquent\Collection;
use Fileshare\Models\{File, Avatar};
use Fileshare\Packers\FilePacker;

class FileSearcher implements SearcherInterface
{
    public function search(string $keyString): array
    {
        $files = File::where('name', 'like', "%{$keyString}%")
            ->limit(100)
            ->get();
        $avatarsId = Avatar::select('parentId')->get()->toArray();
        $filtredFiles = $this->filtrateAvatars($files, $avatarsId);
        return FilePacker::pack($filtredFiles);
    }

    private function filtrateAvatars(Collection $files, array $avatarsId): array
    {
        $filtred = [];
        foreach ($files as $file) {
            if (!in_array($file->id, $avatarsId)) {
                $filtred[] = $file;
            }
        }
        return $filtred;
    }
}
