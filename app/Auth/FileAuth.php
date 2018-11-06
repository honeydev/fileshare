<?php

declare(strict_types=1);

namespace Fileshare\Auth;


use Fileshare\Exceptions\AuthException;

class FileAuth extends AbstractAuth
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
    public function auth($authData)
    {
        $user = $authData['user'];
        $file = $authData['file'];
        $fileOwner = $file->owner();
        if ($user->id === $fileOwner->id) {
            if ($this->acl->userHasPermission($user, 'edit_self_notes')) {
                return true;
            }

            if ($this->acl->userHasPermission($user, 'edit_all_notes')) {
                return true;
            }
        }
        throw new AuthException("User with id {$user->id} didn\\'t have permission edit file {$file->name}");
    }
}
