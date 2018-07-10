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
        $imageShortName = $this->getImageShortName($image);
        $user = UserFactory::createRegularUser();
        $this->tester->haveHttpHeader('Content-Type', 'multipart/form-data');
        $this->tester->sendPost('/uploadavatar.file', ["inline" => 0], ["avatar" => $image]);
        $this->tester->seeResponseContainsJson(["status" => "success"]);
        $this->tester->seeResponseCodeIs(200);
        $response = $this->tester->grabResponse();
        $response = json_decode($response, true);
        $this->assertArrayHasKey(
            "avatarToken",
            $response,
            "
            response must have token, this token identify
            upload avatar image
            "
        );
        $this->assertTrue(file_exists(
            $this->avatarsFolder . "/{$imageShortName}"
            )
        );
        $avatarToken = $response["avatarToken"];
        $this->tester->grabResponse();
        $this->tester->sendAjaxPostRequest("/confirmavatar.form", [
            "userId" => $user->id,
            "avatarToken" => $response["avatarToken"],
            "token" => $user->token
        ]);

        $this->tester->seeResponseContainsJson([
            "status" => "success",
            // "avatarUri" => $user->userInfo->avatar->uri
        ]);
    }

    private function getImageShortName(string $imageUri): string
    {
        $uri = explode('/', $imageUri);
        return $uri[count($uri) - 1];
    }
}

$avatarChangeCept = new AvatarChangeCept(new \FunctionalTester($scenario));
$avatarChangeCept->testSetUserAvatar();
