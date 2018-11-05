<?php

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;
use \Fileshare\Db\factories\UserFactory;
use \Fileshare\Models\User;
use Codeception\Util\Fixtures;
use Faker\Generator as Faker;
use Faker\Provider\Image;

class AvatarChangeCept extends AbstractTest
{
    /**
     * @property string
     */
    private $avatarsFolder;

    private $container;

    private $jwtToken;

    public function __construct($tester)
    {
        parent::__construct($tester);
        $this->container = Fixtures::get("container");
        $this->avatarsFolder = dirname(dirname(__DIR__)) . 
            "/storage/avatars";
    }

    public function testSetUserAvatar()
    {
        $this->tester->wantTo("Set user avatar");
        $image = Image::image();
        $user = UserFactory::createRegularUser($this->container);
        $this->tester->haveHttpHeader("Authorization", "Bearer {$user->token}");
        $this->tester->haveHttpHeader('Content-Type', 'multipart/form-data');
        $this->tester->sendPost('/api/uploadavatar.file', ["inline" => 0], ["file" => $image]);
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(["status" => "success"]);
        $response = json_decode($this->tester->grabResponse(), true);
        $this->assertTrue(file_exists("{$this->avatarsFolder}/{$user->email}/{$response['avatar']['name']}"));
    }

    public function testUserAvatarRelation()
    {
        $this->tester->wantTo("User has correct avatar relation");
        $image = Image::image();
        $user = UserFactory::createRegularUser($this->container);
        $this->tester->haveHttpHeader("Authorization", "Bearer {$user->token}");
        $this->tester->haveHttpHeader('Content-Type', 'multipart/form-data');
        $this->tester->sendPost('/api/uploadavatar.file', ["inline" => 0], ["file" => $image]);
        $this->tester->seeResponseCodeIs(200);
        $response = json_decode($this->tester->grabResponse(), true);
        $this->assertEquals($user->avatar()->uri, $response['avatar']['uri']);
    }
}

$avatarChangeCept = new AvatarChangeCept(new \FunctionalTester($scenario));
$avatarChangeCept->testSetUserAvatar();
$avatarChangeCept->testUserAvatarRelation();