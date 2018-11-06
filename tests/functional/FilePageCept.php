<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use \Fileshare\Db\factories\UserFactory;
use \Fileshare\Models\User;
use \Fileshare\Models\File as FileModel;
use Codeception\Util\Fixtures;
use Faker\Provider\Image;

class FilePageCept extends AbstractTest
{
    use \FileshareTests\traits\CreateFilesTrait;

    public function __construct($tester)
    {
        parent::__construct($tester);
        $this->container = Fixtures::get("container");
        $this->appFolder = dirname(dirname(__DIR__));
    }

    public function testAnonnymFilePageView()
    {
        $this->tester->wantTo("Upload valid file anonym and get file page with correct data");
        $image = Image::image();
        $this->tester->haveHttpHeader('Content-Type', 'multipart/form-data');
        $this->tester->sendPost('/api/uploadfile/anonym.file', ["inline" => 0], ["file" => $image]);
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
        $this->tester->wantTo("Upload valid file anonym and get file");
        $image = Image::image();
        $this->tester->haveHttpHeader('Content-Type', 'multipart/form-data');
        $this->tester->sendPost('/api/uploadfile/anonym.file', ["inline" => 0], ["file" => $image]);
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(["status" => "success"]);
        $response = json_decode($this->tester->grabResponse(), true);
        $fileShortName = $this->getFileNameByUrl($response["fileUrl"]);
        $file = FileModel::getFileByName($fileShortName);
        $fileStream = file_get_contents($this->appFolder . $file->uri);
        $this->tester->sendGET("/file/get/{$fileShortName}");
        $this->tester->seeBinaryResponseEquals(md5($fileStream));
    }

    public function testDeleteFileFeature()
    {
        $this->tester->wantTo("Delete file by owner");
        $owner = UserFactory::createRegularUser($this->container);
        $this->loginTestUser(['email' => $owner->email, 'password' => UserFactory::PASSWORD]);
        $loginResponse = json_decode($this->tester->grabResponse(), true);
        $this->tester->setCookie('token', $loginResponse['loginData']['token']);
        $file = $this->createFilesByUser($owner, 1)[0];
        $this->tester->sendGET("/file/delete/{$file->name}");
        $this->tester->seeResponseCodeIsRedirection();
        $this->tester->amOnPage('/browse');
//        $this->tester->sendGET("/file/{$file->uri}");
//        $this->tester->amOnPage('/404');
    }

    private function getFileNameByUrl($fileUrl)
    {
        $urlAsArray = explode("/", $fileUrl);
        return $urlAsArray[count($urlAsArray) - 1];
    }
}

$filePageCept = new FilePageCept(new \FunctionalTester($scenario));
//$filePageCept->testAnonnymFilePageView();
//$filePageCept->testRequestCorrectFile();
$filePageCept->testDeleteFileFeature();