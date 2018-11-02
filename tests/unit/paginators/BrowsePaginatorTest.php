<?php

use Codeception\Util\Fixtures;

class BrowsePaginatorTest extends \Codeception\Test\Unit
{
    use \FileshareTests\traits\CreateFilesTrait;
    /**
     * @var int
     */
    private $filesOnPage;
    /**
     * @var int
     */
    private $pagesCount;
    /**
     * @var Fileshare\Paginators\BrowsePaginator
     */
    private $browsePaginator;

    protected function _before()
    {
        $container = Fixtures::get('container');
        $this->filesOnPage = $container->get('settings')['filesOnPage'];
        $this->browsePaginator = $container->get('BrowsePaginator');
        $allowCursorValueCalculateService = $container->get('AllowCursorValueCalculateService');
        $selectFilesCountService = $container->get("SelectFilesCountService");
        $this->createFilesAnonymous(30);
        $this->pagesCount = $allowCursorValueCalculateService->calculate($selectFilesCountService->select());
    }

    public function testFirstPagePagination()
    {
        $currentPage = 1;
        $pagination = $this->browsePaginator->paginate($currentPage, $this->pagesCount, ['sortType' => 'late_to_early']);
        $this->assertEquals([
            'leftArrow' => [],
            'rightArrow' => [
                'page' => 2,
                'link' => 'late_to_early/2'
            ]
        ], $pagination);
    }

    public function testLastPagePagination()
    {
        $currentPage = $this->pagesCount;
        $pagination = $this->browsePaginator->paginate($currentPage, $this->pagesCount, ['sortType' => 'late_to_early']);
        $pagePreviousLast = $currentPage - 1;
        $this->assertEquals([
            'leftArrow' => [
                'page' => $pagePreviousLast,
                'link' => "late_to_early/{$pagePreviousLast}"
            ],
            'rightArrow' => []
        ], $pagination);
    }

    public function testMediumPagePagination()
    {
        $currentPage = round($this->pagesCount / 2);
        $pagination = $this->browsePaginator->paginate($currentPage, $this->pagesCount, ['sortType' => 'late_to_early']);
        $previousPage = $currentPage - 1;
        $nextPage = $currentPage + 1;
        $this->assertEquals([
            'leftArrow' => [
                'page' => $previousPage,
                'link' => "late_to_early/{$previousPage}"
            ],
            'rightArrow' => [
                'page' => $nextPage,
                'link' => "late_to_early/{$nextPage}"
            ]
        ], $pagination);
    }
}
