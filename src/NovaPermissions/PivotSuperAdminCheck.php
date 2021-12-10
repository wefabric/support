<?php

namespace Wefabric\Support\NovaPermissions;

use Wefabric\Support\NovaPermissions\Actions\CheckSuperAdminRoleAssignAction;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PivotSuperAdminCheck
{

    /**
     * Add PivotSuperAdminCheck::check(); to the 'EventServiceProvider' boot method to initiate the super admin check.
     */
    public static function check()
    {
        Pivot::creating(function(Pivot $pivot) {
            if(!app(CheckSuperAdminRoleAssignAction::class)->execute($pivot)) {
                throw new \Exception('Alleen een super admin mag een andere super admin toewijzen');
            }
        });

        Pivot::deleting(function(Pivot $pivot) {
            if(!app(CheckSuperAdminRoleAssignAction::class)->execute($pivot)) {
                throw new \Exception('Alleen een super admin mag een andere super admin verwijderen');
            }
        });

        Pivot::updating(function(Pivot $pivot) {
            if(!app(CheckSuperAdminRoleAssignAction::class)->execute($pivot)) {
                throw new \Exception('Alleen een super admin mag een andere super admin verwijderen');
            }
        });
    }
}
