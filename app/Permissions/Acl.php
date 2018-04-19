<?php

namespace Fileshare\Permissions;

use Zend\Permissions\Acl\Acl as ZendAcl;

class Acl extends ZendAcl
{
    public function __construct()
    {
        $this->addRole('guest');
        $this->addRole('member');
        $this->addResource('/');
        $this->addResource('/login');
        $this->addResource('/logout');
        $this->allow('guest', '/', 'GET');
        $this->allow('guest', '/login', array('GET', 'POST'));
        $this->allow('guest', '/logout', 'GET');
    }
}
