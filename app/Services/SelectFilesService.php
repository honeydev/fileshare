<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Codeception\Util\Debug as debug;
use \Fileshare\Models\{File, User, Avatar};
use \Fileshare\Transformers\UserTransformer;
use \Fileshare\Transformers\FileTransformer;

class SelectFilesService
{
    /**
     * @property int
     */
    private $filesOnPage;

    public function __construct($container)
    {
        $this->filesOnPage = $container->get('settings')['filesOnPage'];
    }

    public function select(string $sortType, int $cursor): array
    {
        $filesWithOnwers = [];
        $files = $this->selectFiles($sortType, $cursor);
        foreach ($files as $file) {
            $filesWithOnwers[] = [
                'file' => FileTransformer::transform($file),
                'owner' => UserTransformer::transform($file->owner)
            ];
        }
        return $filesWithOnwers;
    }

    private function selectFiles(string $sortType, int $cursor)
    {
        $files = File::raw('SELECT * FROM files WHERE id NOT IN (SELECT parentId FROM avatars)')
            ->orderBy(...$this->getOrderParams($sortType))
            ->limit($this->filesOnPage)
            ->offset($this->getOffset($cursor))
            ->get();
        return $files;
    }

    private function getOffset(int $cursor): int
    {
        $start = $cursor - 1;
        return $start * $this->filesOnPage;
    }

    private function getOrderParams($sortType = 'late_to_early'): array
    {
        if ($sortType === 'late_to_early') {
            return ["files.created_at", "DESC"];
        } elseif ($sortType === 'early_to_late') {
            return ["files.created_at", "ASC"];
        }
        throw new \InvalidArgumentException("Unknown files browse order type {$sortType}");
    }
}
