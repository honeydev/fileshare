<?php

declare(strict_types=1);

namespace Fileshare\Paginators;


class BrowsePaginator implements PaginatorInterface
{
    private $currentPage;
    private $sortType;

    public function paginate(int $currentPage, int $pagesCount, array $params): array
    {
        $this->currentPage = $currentPage;
        $this->sortType = $params['sortType'];
        $pagination = [];
        return array_merge(
            $pagination,
            $this->prepareLeftArrow(),
            $this->prepareRightArrow($pagesCount)
        );
    }

    private function prepareLeftArrow(): array
    {
        if ($this->currentPage < 2) {
            return ['leftArrow' => null];
        }

        $leftArrow = [];
        $previousPage = $this->currentPage - 1;
        $leftArrow['page'] = $previousPage;
        $leftArrow['link'] = "{$this->sortType}/{$previousPage}";
        return ['leftArrow' => $leftArrow];
    }

    private function prepareRightArrow(int $pagesCount): array
    {
        if ($this->currentPage === $pagesCount) {
            return ['rightArrow' => null];
        }

        $rightArrow = [];
        $nextPage = $this->currentPage + 1;
        $rightArrow['page'] = $nextPage;
        $rightArrow['link'] = "{$this->sortType}/{$nextPage}";
        return ['rightArrow' => $rightArrow];
    }
}
