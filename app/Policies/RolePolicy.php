<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    CONST abilities = [
        'VIEW' => 'view-role',
        'CREATE' => 'create-role',
        'UPDATE' => 'update-role',
        'DELETE' => 'delete-role',
        'RESTORE' => 'restore-role',
        'FORCE_DELETE' => 'force-delete-role'
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
    public function view(User $user, Role $role): bool
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
    public function update(User $user, Role $role): bool
    {
        return Helper::checkPermission($user, [], self::abilities['UPDATE']) && $role->can_edit;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return Helper::checkPermission($user, [], self::abilities['DELETE']) && $role->can_delete;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return Helper::checkPermission($user, [], self::abilities['RESTORE']) && $role->can_delete;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return Helper::checkPermission($user, [], self::abilities['FORCE_DELETE']) && $role->can_delete;
    }
}
