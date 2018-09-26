<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use Codeception\Util\Fixtures;
use \Fileshare\Db\factories\FileFactory;
use \Fileshare\Models\User;
use Fileshare\Helpers\FilesSortHelper;
use function \Funct\Collection\invoke;

class BrowseFilesPageCept extends AbstractTest
{
    /**
     * @const {int} how much create fake files
     */
    const TEST_FILES_COUNT = 5;

    public function __construct($tester)
    {
        parent::__construct($tester);
        $this->container = Fixtures::get("container");
        $this->appFolder = dirname(dirname(__DIR__));
    }

    public function testLastFilesView()
    {
        $this->tester->wantTo("See json with file data accord selector");
        $files = $this->createFiles();
        $this->tester->sendGET("/browse/late_to_early");
        $this->tester->seeResponseCodeIs(200);

        foreach ($files as $file) {
            $this->tester->seeResponseContains($file['name']);
        }
    }

    private function createFiles($sortType = null): array
    {
        $files = [];

        for ($i = 0; $i < self::TEST_FILES_COUNT; $i++) {
            $file = FileFactory::createFile(User::getUserByEmail('annonymous@fileshare'));
            $files[] = $file;
        }

        if ($sortType === 'early_to_late') {
            $files = FilesSortHelper::earlyToLateSort($files);
        }

        $filesAsArrays = invoke($files, function ($file) {
            return $file->toArray();
        });

        return $filesAsArrays;
    }
}

$browseFilesPageCept = new BrowseFilesPageCept(new \FunctionalTester($scenario));
$browseFilesPageCept->testLastFilesView();