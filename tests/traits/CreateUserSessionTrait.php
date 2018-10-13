<?php

declare(strict_types=1);

namespace FileshareTests\traits;

trait CreateUserSessionTrait
{
	private function createRegularUserSession($container): \Fileshare\Models\SessionModel
    {
        $sessionModel = $this->container->get('SessionModel');
        $sessionModel->authorizeStatus = true;
        $sessionModel->accessLvl = 1;
        $sessionModel->ip = '192.168.54.2';
        $sessionModel->user = $this->container->get('RegularUserModel');
        $sessionModel->user->email = 'testuesr@test.com';
        $sessionModel->user->name = 'Test user';
        $sessionModel->user->id = '7';
        return $sessionModel;
    }

    private function createAdminUserSession($container): \Fileshare\Models\SessionModel
    {
        $sessionModel = $this->container->get('SessionModel');
        $sessionModel->authorizeStatus = true;
        $sessionModel->accessLvl = 2;
        $sessionModel->ip = '192.168.54.2';
        $sessionModel->user = $this->container->get('AdminUserModel');
        $sessionModel->user->email = 'testadminuesr@test.com';
        $sessionModel->user->name = 'Test user';
        $sessionModel->user->id = '7';
        return $sessionModel;
    }
}
