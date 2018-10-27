<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 25.10.18
 * Time: 7:17
 */

namespace Fileshare\Paginators;

abstract class AbstractPaginator implements PaginatorInterface
{
    /**
     * @property int
     */
    protected $currentPage;
    /**
     * @property int
     */
    protected $pagesCount;


    abstract public function paginate(int $currentPage, int $pagesCount, array $params): array;

    protected function prepareLeftArrow(): array
    {
        if ($this->currentPage < 2) {
            return [];
        }

        $leftArrow = [];
        $leftArrow['page']  =$this->currentPage - 1;
        return $leftArrow;
    }

    protected function prepareRightArrow(): array
    {
        if ($this->currentPage === $this->pagesCount) {
            return [];
        }

        $rightArrow = [];
        $rightArrow['page'] = $this->currentPage + 1;
        return $rightArrow;
    }

    protected function formatLink(array $parts): string
    {
        return implode("/", $parts);
    }
}
