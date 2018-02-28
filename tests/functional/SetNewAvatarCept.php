<?php
/**
 * @class SetNewAvatarCept
 */

declare(strict_types=1);

namespace FileshareTests\functional;

use \Codeception\Util\Debug as debug;

class SetNewAvatarCept extends AbstractTest
{
    public function __construct(\FunctionalTester $tester)
    {
        parent::__construct($tester);
        $this->setXhrRequestType();
        $this->setUserIp();
        $this->testUserId = $this->createRegularUser();
        $this->setSession();
        $this->loginTestUser(array('email' => 'testuser@test.com', 'password' => 'testuserpassword'));
    }

    public function sendRequestWithNewAvatar()
    {
        $this->tester->wantTo('See complete request with uri my avatar');
        debug::debug(codecept_data_dir());
        $this->tester->sendAjaxRequest('PUT', '/userAvatar.file', array('file' => array(
            'name' => 'myFile.jpg',
            'type' => 'image/jpeg',
            'error' => UPLOAD_ERR_OK,
            'size' => filesize(codecept_data_dir('avatar.png')),
            'tmp_name' => codecept_data_dir('avatar.png')
        )));
        $this->tester->seeResponseCodeIs(200);
        $this->tester->seeResponseContainsJson(array("status" => "success"));
    }
}

$setNewAvatarCept = new SetNewAvatarCept(new \FunctionalTester($scenario));
$setNewAvatarCept->sendRequestWithNewAvatar();