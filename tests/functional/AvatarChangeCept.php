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
        $user = UserFactory::createRegularUser();
        $response = $this->tester->sendPost('/uploadavatar.file', ["inline" => 0], ["file" => $image]);
        $this->tester->seeResponseContainsJson(["status" => "success"]);
        $this->tester->seeResponseCodeIs(200);
    }
}

$avatarChangeCept = new AvatarChangeCept(new \FunctionalTester($scenario));
$avatarChangeCept->testSetUserAvatar();
