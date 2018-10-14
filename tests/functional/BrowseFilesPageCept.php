<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use Codeception\Util\Fixtures;
use \Fileshare\Db\factories\FileFactory;
use \Fileshare\Models\User;
use Fileshare\Helpers\FilesSortHelper;
use Fileshare\Transformers\FileTransformer;
use function \Funct\Collection\invoke;

class BrowseFilesPageCept extends AbstractTest
{
    /**
     * @const {int} how much create fake files
     */
    const TEST_FILES_COUNT = 20;
    /**
     * @var int
     */
    private $filesPerPage;
    /**
     * @var array contain \Fileshare\Models\File
     */
    private $files;

    public function __construct($tester)
    {
        parent::__construct($tester);
        $this->container = Fixtures::get("container");
        $this->appFolder = dirname(dirname(__DIR__));
        $this->filesPerPage = $this->container->get('settings')['filesOnPage'];
        $this->files = $this->createFiles();
    }

    private function createFiles(): array
    {
        $files = [];

        for ($i = 0; $i < self::TEST_FILES_COUNT; $i++) {
            $file = FileFactory::createFile(User::getUserByEmail('anonymous@fileshare'));
            $files[] = $file;
            /* delay insert for correct timestamps different in db notes */
            usleep(1000000);
        }

        return $files;
    }

    public function testLastUploadedFilesSelect()
    {
        $this->tester->wantTo("See last uploaded files");
        $this->tester->sendGET("/browse/late_to_early");
        $this->tester->seeResponseCodeIs(200);
        $files = FilesSortHelper::lateToEarlySort($this->files);
        $files = self::filesAsArraysForView($files);
        for ($i = 0; $i < $this->filesPerPage ; $i++) {
            $this->seeResponseContainsFileProperties($files[$i]);
        }
    }

    public function testFirstUploadedFilesSelect()
    {
        $this->tester->wantTo("See first uploaded files");
        $this->tester->sendGET("/browse/early_to_late");
        $this->tester->seeResponseCodeIs(200);
        $files = FilesSortHelper::earlyToLateSort($this->files);
        $files = self::filesAsArraysForView($files);
        for ($i = 0; $i < $this->filesPerPage ; $i++) {
            $this->seeResponseContainsFileProperties($files[$i]);
        }
    }

    public function testFilesSelectAccordCursor()
    {
        $this->tester->wantTo("See files select accord cursor");
        $cursor = 2;
        $this->tester->sendGET("/browse/late_to_early/{$cursor}");
        $this->tester->seeResponseCodeIs(200);
        $files = FilesSortHelper::lateToEarlySort($this->files);
        $files = $this->filesAsArraysForView($files);
        $firstFileIndex = $this->filesPerPage * ($cursor - 1);
        $lastFileIndex = $firstFileIndex + $this->filesPerPage;
        for ($i = $firstFileIndex; $i < $lastFileIndex; $i++) {
            $this->seeResponseContainsFileProperties($files[$i]);
        }
    }

    public function testRedirectIfCursorIsIncorrect()
    {
        $this->tester->wantTo("See first uploaded files");
        $incorrectCursor = 0;
        $this->tester->sendGET("/browse/early_to_late/{$incorrectCursor}");
        $this->tester->seeResponseCodeIs(404);
    }
    /**
     * transform file objects to array, it's equal file statment in browse file view
     */
    private function filesAsArraysForView(array $files): array
    {
        return invoke($files, function ($file) {
            return FileTransformer::transform($file);
        });
    }

    private function seeResponseContainsFileProperties(array $file)
    {
        $this->tester->seeResponseContains($file['name']);
        $this->tester->SeeResponseContains($file['size']);
        $this->tester->SeeResponseContains($file['created']);
        $this->tester->SeeResponseContains($file['filePageUrl']);
    }
}

$browseFilesPageCept = new BrowseFilesPageCept(new \FunctionalTester($scenario));
//$browseFilesPageCept->testLastUploadedFilesSelect();
//$browseFilesPageCept->testFirstUploadedFilesSelect();
//$browseFilesPageCept->testFilesSelectAccordCursor();
$browseFilesPageCept->testRedirectIfCursorIsIncorrect();