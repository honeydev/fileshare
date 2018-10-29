<?php

declare(strict_types=1);

namespace Fileshare\Paginators;

class BrowsePaginator extends AbstractPaginator implements PaginatorInterface
{
    /**
     * @property string
     */
    private $sortType;

    public function paginate(int $currentPage, int $pagesCount, array $params = []): array
    {
        $this->currentPage = $currentPage;
        $this->pagesCount = $pagesCount;
        $this->sortType = $params['sortType'];
        $pagination = [];
        $pagination['leftArrow'] = $this->prepareLeftArrow();
        $pagination['rightArrow'] = $this->prepareRightArrow();
        return $pagination;
    }

    protected function prepareLeftArrow(): array
    {
        if (empty($leftArrow = parent::prepareLeftArrow())) {
            return $leftArrow;
        }
        $leftArrow['link'] = $this->formatLink([$this->sortType, $leftArrow['page']]);
        return $leftArrow;
    }

    protected function prepareRightArrow(): array
    {
        if (empty($rightArrow = parent::prepareRightArrow())) {
            return $rightArrow;
        }
        $rightArrow['link'] = $this->formatLink([$this->sortType, $rightArrow['page']]);
        return $rightArrow;
    }

    protected function formatLink(array $parts): string
    {
        return "/" . implode("/", $parts);
    }
}
