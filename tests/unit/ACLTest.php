<?php

namespace FileshareTests;

use Codeception\Util\Fixtures;
use \Codeception\Util\Debug as debug;
use \Fileshare\Models\User;
use \Fileshare\Models\UserSettings;
use \Ds\Queue;

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
        $user = \Fileshare\Db\factories\UserFactory::createRegularUser();

        $this->tester->assertTrue($this->acl->userHasPermission($user, 'read_public_notes'));
        $this->tester->assertFalse($this->acl->userHasPermission($user, 'edit_all_profile'));
    }

    public function testUserHasAtLeastOnePermission()
    {
        $user = \Fileshare\Db\factories\UserFactory::createRegularUser();
        $this->tester->assertTrue($this->acl->userHasAtLeastOnePermission($user, new Queue([
            'edit_all_profile', 'write_self_notes'
        ])));
    }
}
