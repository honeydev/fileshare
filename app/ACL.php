<?php

declare(strict_types=1);

namespace Fileshare;

use \Ds\Set;
use \Fileshare\Models\User;

class ACL
{
    private $permissions;

    public function __construct()
    {
        $this->permissions = [
            'read_public_notes' => new Set([0, 1, 2]),
            'write_self_notes' => new Set([1, 2]),
            'edit_self_profile' => new Set([1, 2]),
            'edit_all_profile' => new Set([2]),
            'edit_all_notes' => new Set([2])
        ];
    }

    public function userHavePermission(User $user, $permissionName): bool
    {
        if (!array_key_exists($permissionName, $this->permissions)) {
            throw new \InvalidArgumentException("Not exist permission {$permissionName}");
        }
        $permission = $this->permissions[$permissionName];
        $accessLvl = $user->userSettings->accessLvl;

        return $permission->contains($accessLvl);
    }
}
