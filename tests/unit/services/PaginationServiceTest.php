<?php
/**
 * Created by PhpStorm.
 * User: honey
 * Date: 14.10.18
 * Time: 15:43
 */

use \Fileshare\Models\User;
use \Fileshare\Db\factories\FileFactory;
use Codeception\Util\Fixtures;

class PaginationServiceTest extends \Codeception\Test\Unit
{
    const TEST_FILES_COUNT = 30;
    private $filesOnPage;
    private $paginationService;
    private $pagesCount;

    protected function _before()
    {
        $container = Fixtures::get('container');
        $this->filesOnPage = $container->get('settings')['filesOnPage'];
        $allowCursorValueCalculateService = $container->get('AllowCursorValueCalculateService');
        $this->paginationService = $container->get('PaginationService');
        $this->createFiles();
        $this->pagesCount = $allowCursorValueCalculateService->calculate();
    }

    public function testFirstPagePagination()
    {
        $result = $this->paginationService->preparePagination(1);
        $this->assertEquals([
            'leftArrow' => '&laquo;',
            'rightArrow' => '&raquo;',
            'pages' => range(1, $this->pagesCount)
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
