<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use \Fileshare\Db\factories\UserFactory;
use \Fileshare\Models\User;
use \Fileshare\Models\File as FileModel;
use Codeception\Util\Fixtures;
use Faker\Generator as Faker;
use Faker\Provider\Image;
use Faker\Provider\File;

class FilePageCept extends AbstractTest
{
    public function __construct($tester)
    {
        parent::__construct($tester);
        $this->container = Fixtures::get("container");
        $this->appFolder = dirname(dirname(__DIR__));
    }

    public function testFilePageView()
    {
        $this->tester->wantTo("Upload valid file annonym and get file page with correct data");
        $image = Image::image();
        $this->tester->haveHttpHeader('Content-Type', 'multipart/form-data');
        $this->tester->sendPost('/api/uploadfile/annonym.file', ["inline" => 0], ["file" => $image]);
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(["status" => "success"]);
        $response = json_decode($this->tester->grabResponse(), true);
        $fileShortName = $this->getFileNameByUrl($response["fileUrl"]);
        $file = FileModel::getFileByName($fileShortName);
        $this->tester->sendGET($response["fileUrl"]);
        $this->tester->seeResponseContains($file->name);
    }

    public function testRequestCorrectFile()
    {
        $this->tester->wantTo("Upload valid file annonym and get file");
        $image = Image::image();
        $this->tester->haveHttpHeader('Content-Type', 'multipart/form-data');
        $this->tester->sendPost('/api/uploadfile/annonym.file', ["inline" => 0], ["file" => $image]);
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(["status" => "success"]);
        $response = json_decode($this->tester->grabResponse(), true);
        $fileShortName = $this->getFileNameByUrl($response["fileUrl"]);
        $file = FileModel::getFileByName($fileShortName);
        $fileStream = file_get_contents($this->appFolder . $file->uri);
        $this->tester->sendGET("/file/get/{$fileShortName}");
        $this->tester->seeBinaryResponseEquals(md5($fileStream));
    }

    private function getFileNameByUrl($fileUrl)
    {
        $urlAsArray = explode("/", $fileUrl);
        return $urlAsArray[count($urlAsArray) - 1];
    }
}

$filePageCept = new FilePageCept(new \FunctionalTester($scenario));
$filePageCept->testFilePageView();
//$filePageCept->testRequestCorrectFile();