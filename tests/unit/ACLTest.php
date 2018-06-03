<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;
use \Fileshare\Models\User;
use \Fileshare\Models\UserSettings;

class ACLTest extends \FileshareTests\unit\AbstractTest
{
    protected $container;
    private $acl;

    protected function _before()
    {
        $this->acl = $this->container->get('ACL');
    }

    protected function _after()
    {
    }

    public function testGetPermission()
    {
        $user = \Fileshare\Db\factories\UserFactory::generate();

        $this->tester->assertTrue($this->acl->userHavePermission($user, 'read_public_notes'));
        $this->tester->assertFalse($this->acl->userHavePermission($user, 'edit_all_profile'));
    }
}
