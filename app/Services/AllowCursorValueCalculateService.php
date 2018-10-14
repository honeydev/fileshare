<?php

declare(strict_types=1);

namespace Fileshare\Services;

use Fileshare\Models\File;


class AllowCursorValueCalculateService
{
    /**
     * @var int
     */
    private $filesOnPage;

    public function __construct($container)
    {
        $this->filesOnPage = $container->get('settings')['filesOnPage'];
    }

    public function calculate(): int
    {
        $filesCount = $this->selectCountFilesNotes();
        return  intval($filesCount / $this->filesOnPage);
    }

    private function selectCountFilesNotes(): int
    {
        $files = File::raw('SELECT * FROM files WHERE id NOT IN (SELECT parentId FROM avatars)')->get();
        return count($files);
    }
}
