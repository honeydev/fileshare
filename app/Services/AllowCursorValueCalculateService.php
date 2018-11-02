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

    public function calculate(int $filesCount): int
    {
        if ($filesCount <= $this->filesOnPage) {
            $allowPages = 1;
        } else {
            $allowPages = ceil($filesCount / $this->filesOnPage);
        }
        return (int) $allowPages;
    }
}
