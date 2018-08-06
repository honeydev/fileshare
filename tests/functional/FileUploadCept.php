<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use \Fileshare\Db\factories\UserFactory;
use \Fileshare\Models\User;
use Codeception\Util\Fixtures;
use Faker\Generator as Faker;
use Faker\Provider\Image;
use Faker\Provider\File;

class FileUploadCept extends AbstractTest
{
    public function __construct($tester)
    {
        parent::__construct($tester);
        $this->container = Fixtures::get("container");
        $this->fileFolder = dirname(dirname(__DIR__)) . 
            "/storage/uploads";
    }

    public function testValidFileUploadAnnonym()
    {
        $this->tester->wantTo("Upload valid file annonym and see response with link on file");
        $image = Image::image();
        $this->tester->haveHttpHeader('Content-Type', 'multipart/form-data');
        $this->tester->sendPost('/api/uploadfile/annonym.file', ["inline" => 0], ["file" => $image]);
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(["status" => "success"]);
        $response = json_decode($this->tester->grabResponse(), true);
        $this->assertTrue(array_key_exists("fileUrl", $response));
    }

    public function testValidFileUploadRegistred()
    {
        $this->tester->wantTo("Upload valid file registred user and see response with link on file");
        $user = UserFactory::createRegularUser($this->container);
        $image = Image::image();
        $this->tester->haveHttpHeader("Authorization", "Bearer {$user->token}");
        $this->tester->haveHttpHeader('Content-Type', 'multipart/form-data');
        $this->tester->sendPost('/api/uploadfile/registred.file', ["inline" => 0], ["file" => $image]);
        $this->tester->seeResponseCodeIs(200);
    }

    public function testInvalidFileUploadSize()
    {
        $this->tester->wantTo("Upload invalid file");
        //todo implement
    }
}

$fileUploadCept = new FileUploadCept(new \FunctionalTester($scenario));
$fileUploadCept->testValidFileUploadAnnonym();
$fileUploadCept->testValidFileUploadRegistred();
$fileUploadCept->testInvalidFileUploadSize();