<?php

declare(strict_types=1);

namespace Fileshare\Paginators;

class SearchPaginator extends AbstractPaginator implements PaginatorInterface
{
    private $searchRequest;

    public function paginate(int $currentPage, int $pagesCount, array $params = []): array
    {
        $this->currentPage = $currentPage;
        $this->pagesCount = $pagesCount;
        $this->searchRequest = $params['searchRequest'];
        $pagination = [];
        $pagination['leftArrow'] = $this->prepareLeftArrow();
        $pagination['rightArrow'] = $this->prepareRightArrow();
        return $pagination;
    }

    protected function prepareLeftArrow(): array
    {
        $leftArrow = parent::prepareLeftArrow();
        if (empty($leftArrow)) {
            return $leftArrow;
        }
        $leftArrow['link'] = $this->formatLink($leftArrow['page']);
        return $leftArrow;
    }

    protected function prepareRightArrow(): array
    {
        if (empty($rightArrow = parent::prepareRightArrow())) {
            return $rightArrow;
        }
        $rightArrow['link'] = $this->formatLink($rightArrow['page']);
        return $rightArrow;
    }

    private function formatLink(int $page): string
    {
        return "?searchRequest={$this->searchRequest}&page={$page}";
    }
}
