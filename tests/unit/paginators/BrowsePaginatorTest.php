<?php

use Codeception\Util\Fixtures;

class BrowsePaginatorTest extends \Codeception\Test\Unit
{
    use \FileshareTests\traits\CreateFilesTrait;

    private $filesOnPage;
    private $paginationService;
    private $allowCursorValueCalculateService;

    protected function _before()
    {
        $container = Fixtures::get('container');
        $this->filesOnPage = $container->get('settings')['filesOnPage'];
        $this->browsePaginator = $container->get('BrowsePaginator');
        $this->allowCursorValueCalculateService = $container->get('AllowCursorValueCalculateService');
        $this->createFilesAnonymous(30);
    }

    public function testFirstPagePagination()
    {
        $pagesCount = $this->allowCursorValueCalculateService->calculate();
        $currentPage = 1;
        $pagination = $this->browsePaginator->paginate($currentPage, $pagesCount, ['sortType' => 'late_to_early']);
        $this->assertEquals([
            'leftArrow' => null,
            'rightArrow' => [
                'page' => 2,
                'link' => 'late_to_early/2'
            ]
        ], $pagination);
    }

    public function testLastPagePagination()
    {
        $pagesCount = $this->allowCursorValueCalculateService->calculate();
        $currentPage = $pagesCount;
        $pagination = $this->browsePaginator->paginate($currentPage, $pagesCount, ['sortType' => 'late_to_early']);
        $pagePreviousLast = $currentPage - 1;
        $this->assertEquals([
            'leftArrow' => [
                'page' => $pagePreviousLast,
                'link' => "late_to_early/{$pagePreviousLast}"
            ],
            'rightArrow' => null
        ], $pagination);
    }

    public function testMediumPagePagination()
    {
        $pagesCount = $this->allowCursorValueCalculateService->calculate();
        $currentPage = round($pagesCount / 2);
        $pagination = $this->browsePaginator->paginate($currentPage, $pagesCount, ['sortType' => 'late_to_early']);
        $previusPage = $currentPage - 1;
        $nextPage = $currentPage + 1;
        $this->assertEquals([
            'leftArrow' => [
                'page' => $previusPage,
                'link' => "late_to_early/{$previusPage}"
            ],
            'rightArrow' => [
                'page' => $nextPage,
                'link' => "late_to_early/{$nextPage}"
            ]
        ], $pagination);
    }
}
