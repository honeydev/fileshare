<?php

use \Fileshare\Models\User;
use \Fileshare\Db\factories\FileFactory;
use Codeception\Util\Fixtures;

class PaginationServiceTest extends \Codeception\Test\Unit
{
    const TEST_FILES_COUNT = 30;
    private $filesOnPage;
    private $paginationService;
    private $allowCursorValueCalculateService;

    protected function _before()
    {
        $container = Fixtures::get('container');
        $this->filesOnPage = $container->get('settings')['filesOnPage'];
        $allowCursorValueCalculateService = $container->get('AllowCursorValueCalculateService');
        $this->paginationService = $container->get('PaginationService');
        $this->allowCursorValueCalculateService = $container->get('AllowCursorValueCalculateService');
        $this->createFiles();
    }

    public function testFirstPagePagination()
    {
        $pagesCount = $this->allowCursorValueCalculateService->calculate();
        $currentPage = 1;
        $pagination = $this->paginationService->preparePagination($pagesCount, $currentPage);
        $this->assertEquals([
            'leftArrow' => [],
            'rightArrow' => ['page' => 2, 'symbol' => '»'],
            'currentPage' => $currentPage,
            'pages' => range(1, $pagesCount)
        ], $pagination);
    }

    public function testLastPagePagination()
    {
        $pagesCount = $this->allowCursorValueCalculateService->calculate();
        $currentPage = $pagesCount;
        $result = $this->paginationService->preparePagination($pagesCount, $currentPage);
        $this->assertEquals([
            'leftArrow' => ['page' => $currentPage - 1, 'symbol' => '«'],
            'rightArrow' => [],
            'currentPage' => $currentPage,
            'pages' => range(1, $pagesCount)
        ], $result);
    }

    public function testMediumPagePagination()
    {
        $pagesCount = $this->allowCursorValueCalculateService->calculate();
        $currentPage = round($pagesCount / 2);
        $result = $this->paginationService->preparePagination($pagesCount, $currentPage);
        $this->assertEquals([
            'leftArrow' => ['page' => $currentPage - 1, 'symbol' => '«'],
            'rightArrow' => ['page' => $currentPage + 1, 'symbol' => '»'],
            'currentPage' => $currentPage,
            'pages' => range(1, $pagesCount)
        ], $result);        
    }

    private function createFiles()
    {
        $files = [];

        for ($i = 0; $i < self::TEST_FILES_COUNT; $i++) {
            $file = FileFactory::createFile(User::getUserByEmail('anonymous@fileshare'));
            $files[] = $file;
        }

        return $files;
    }
}
