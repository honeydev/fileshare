<?php

declare(strict_types=1);

namespace FileshareTests\unit\traits;

use \Fileshare\Models\SessionModel as SessionModel;

trait CreateUserSessionTrait
{
    private function createGuestSession($container): SessionModel
    {
        $sessionModel = $container->get('SessionModel');
        $sessionModel->authorizeStatus = false;
        $sessionModel->accessLvl = 0;
        $sessionModel->ip = '192.168.54.2';
        $sessionModel->user = $container->get('GuestUserModel');
        return $sessionModel;
    }

	private function createRegularUserSession($container): SessionModel
    {
        $sessionModel = $container->get('SessionModel');
        $sessionModel->authorizeStatus = true;
        $sessionModel->accessLvl = 1;
        $sessionModel->ip = '192.168.54.2';
        $sessionModel->user = $container->get('RegularUserModel');
        $sessionModel->user->email = 'testuesr@test.com';
        $sessionModel->user->name = 'Test user';
        $sessionModel->user->id = '7';
        return $sessionModel;
    }

    private function createAdminUserSession($container): SessionModel
    {
        $sessionModel = $container->get('SessionModel');
        $sessionModel->authorizeStatus = true;
        $sessionModel->accessLvl = 2;
        $sessionModel->ip = '192.168.54.2';
        $sessionModel->user = $container->get('AdminUserModel');
        $sessionModel->user->email = 'testadminuesr@test.com';
        $sessionModel->user->name = 'Test user';
        $sessionModel->user->id = '7';
        return $sessionModel;
    }
}
