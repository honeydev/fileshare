<?php

declare(strict_types=1);

namespace Fileshare\Auth;

use Fileshare\Exceptions\AuthException as AuthException;
use Fileshare\Models\User;
use \Codeception\Util\Debug as debug;
use \Ds\Queue;

class ProfileAuth extends AbstractAuth
{
    /**
     * @param \Fileshare\ACL
     */
    private $acl;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->acl = $container->get("ACL");
    }
    /**
     * @throws AuthException
     * @param array [$user => Fileshare\Models\User, 'targetId' => int]
     */
    public function auth($authData)
    {
        $user = $authData['user'];
        $targetId = $authData['targetProfileId'];
        if ($user->id === $targetId) {
            if (!$this->acl->userHasPermission($user, 'edit_self_profile')) {
                throw new AuthException("User {Fileshare\Models\User$user->id} didn\\'t have permission edit profile");
            }
        } else {
            if (!$this->acl->userHasPermission($user, 'edit_all_profile')) {
                throw new AuthException("User {Fileshare\Models\User$user->id} didn\\'t have permission edit profile");
            }
        }
        return true;
    }
}
