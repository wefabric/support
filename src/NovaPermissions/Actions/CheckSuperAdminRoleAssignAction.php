<?php

namespace Wefabric\Support\NovaPermissions\Actions;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CheckSuperAdminRoleAssignAction
{
    /**
     * @param Pivot $pivot
     * @return bool
     */
    public function execute(Pivot $pivot)
    {
        if($superAdminRoleId = config('nova-permissions.super_admin_role_id')) {
            if ($pivot->getTable() == 'role_user') {
                $roleId = (int)$pivot->getAttribute('role_id');
                if($roleId && $roleId === $superAdminRoleId) {
                    if(!request()->user()->roles()->where('id', $superAdminRoleId)->first()) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

}
