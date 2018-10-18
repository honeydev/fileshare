<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use Codeception\Util\Fixtures;
use \Fileshare\Db\factories\FileFactory;
use \Fileshare\Models\{User, File};
use Fileshare\Helpers\FilesSortHelper;
use Fileshare\Transformers\FileTransformer;
use function \Funct\Collection\invoke;

class SearchPageCept extends AbstractTest
{
    public function __construct($tester)
    {
        parent::__construct($tester);
        $this->container = Fixtures::get("container");
    }

    public function testSearchByFullFileNameCoincidence()
    {
        $this->tester->wantTo("See requirement file first in search result");
        $this->createFiles(20);
        $file = $this->selectRandomFile();
        $this->tester->sendGET("/search/{$file->name}");
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContains($file->name);
    }

    private function selectRandomFile(): File
    {
        $file = File::raw('SELECT * FROM files WHERE id NOT IN (SELECT parentId FROM avatars)')
            ->inRandomOrder()
            ->limit(1)
            ->get()[0];
        return $file;
    }
}

$test = new SearchPageCept(new \FunctionalTester($scenario));
$test->testSearchByFullFileNameCoincidence();