<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    CONST abilities = [
        'VIEW' => 'permission:detail',
        'CREATE' => 'permission:create',
        'UPDATE' => 'permission:update',
        'DELETE' => 'permission:delete',
        'RESTORE' => 'permission:restore',
        'FORCE_DELETE' => 'permission:force-delete',
        'LIST' => 'permission:pagination'
    ];

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Helper::checkPermission($user, collect(self::abilities)->values()->toArray());
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Permission $permission): bool
    {
        return Helper::checkPermission($user, [], self::abilities['VIEW']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Helper::checkPermission($user, [], self::abilities['CREATE']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        return Helper::checkPermission($user, [], self::abilities['UPDATE']) && $permission->can_edit;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
        return Helper::checkPermission($user, [], self::abilities['DELETE']) && $permission->can_delete;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permission $permission): bool
    {
        return Helper::checkPermission($user, [], self::abilities['RESTORE']) && $permission->can_delete;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permission $permission): bool
    {
        return Helper::checkPermission($user, [], self::abilities['FORCE_DELETE']) && $permission->can_delete;
    }
}
