<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use Codeception\Util\Fixtures;
use \Fileshare\Models\{User, File};

class SearchPageCept extends AbstractTest
{
    use \FileshareTests\traits\CreateFilesTrait;

    public function __construct($tester)
    {
        parent::__construct($tester);
        $this->container = Fixtures::get("container");
    }

    public function testSearchByFullFileNameCoincidence()
    {
        $this->tester->wantTo("See requirement file first in search result");
        $this->createFilesAnonymous(20);
        $file = $this->selectRandomFile();
        $this->tester->sendGET("/search", ["searchRequest" => $file->name]);
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContains($file->name);
    }

    public function testErrorOnEmptyRequest()
    {
        $this->tester->wantTo("See error about empty request");
        $this->tester->sendGET('/search', ["searchRequest" => "\n"]);
        $this->tester->seeResponseCodeIs(400);
        $this->tester->seeResponseContains("Empty search request");
    }

    public function testErrorRequestInvalidLength()
    {
        $this->tester->wantTo("See error about invalid request length");
        $randomString = (string) implode('', range(0, 200));
        $this->tester->sendGET('/search', ["searchRequest" => $randomString]);
        $this->tester->seeResponseContains("Search request length cant be more than 200 symbols");
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
// $test->testSearchByFullFileNameCoincidence();
// $test->testErrorOnEmptyRequest();
$test->testErrorRequestInvalidLength();