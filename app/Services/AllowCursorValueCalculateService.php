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
    /**
     * @var Fileshare\Services\SelectFilesCountService
     */
    private $selectFilesCountService;

    public function __construct($container)
    {
        $this->filesOnPage = $container->get('settings')['filesOnPage'];
        $this->selectFilesCountService = $container->get('SelectFilesCountService');
    }

    public function calculate(): int
    {
        $filesCount = $this->selectFilesCountService->select();
        return  intval($filesCount / $this->filesOnPage);
    }
}