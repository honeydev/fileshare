<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 14.10.18
 * Time: 15:15
 */

namespace Fileshare\Services;


class PaginationService
{
    /**
     * @var \Fileshare\Services\AllowCursorValueCalculateService
     */
    private $allowCursorValueCalculateService;

    public function __construct($container)
    {
        $this->allowCursorValueCalculateService = $container->get('AllowCursorValueCalculateService');
    }

    public function preparePagination(int $currentPage)
    {
        $pagination = [];
        $pagesCounter = $this->allowCursorValueCalculateService->calculate();


        foreach (range(1, $pagesCounter) as $page) {
            //todo implement
        }
    }

    private function prepareNavigationArrows(int $pagesCounter, int $currentPage)
    {
    }
}
