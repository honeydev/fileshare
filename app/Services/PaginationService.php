<?php

declare(strict_types=1);

namespace Fileshare\Services;

use \Codeception\Util\Debug as debug;

class PaginationService
{
    public function preparePagination(int $pagesCount, int $currentPage): array
    {
        $pagination = [];
        $pagination = array_merge($pagination, $this->prepareNavigationArrows($pagesCount, $currentPage));
        $pagination['pages'] = $this->preparePages($pagesCount);
        $pagination['currentPage'] = $currentPage;
        return $pagination;
    }

    private function prepareNavigationArrows(int $pagesCount, int $currentPage): array
    {
        $arrows = [];
        $arrows['leftArrow'] = $arrows['rightArrow'] = [];
        $leftArrowSymbol = '«';
        $rightArrowSymbol = '»';
        if ($pagesCount < 2) {
            return $arrows;
        }

        if ($currentPage === 1) {
            $arrows['rightArrow']['symbol'] = $rightArrowSymbol;
            $arrows['rightArrow']['page'] = $currentPage + 1;
        } elseif ($currentPage === $pagesCount) {
            $arrows['leftArrow']['symbol'] = $leftArrowSymbol;
            $arrows['leftArrow']['page'] = $currentPage - 1;
        } else {
            $arrows['leftArrow']['symbol'] = $leftArrowSymbol;
            $arrows['rightArrow']['symbol'] = $rightArrowSymbol;
            $arrows['rightArrow']['page'] = $currentPage + 1;
            $arrows['leftArrow']['page'] = $currentPage - 1;
        }
        return $arrows;
    }

    private function preparePages(int $pagesCount): array
    {
        return range(1, $pagesCount);
    }
}
