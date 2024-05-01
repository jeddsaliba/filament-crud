<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Models\Module;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ModulePolicy
{
    CONST abilities = [
        'VIEW' => 'module:detail',
        'CREATE' => 'module:create',
        'UPDATE' => 'module:update',
        'DELETE' => 'module:delete',
        'RESTORE' => 'module:restore',
        'FORCE_DELETE' => 'module:force-delete',
        'LIST' => 'module:pagination'
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
    public function view(User $user, Module $module): bool
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
    public function update(User $user, Module $module): bool
    {
        return Helper::checkPermission($user, [], self::abilities['UPDATE']) && $module->can_edit;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Module $module): bool
    {
        return Helper::checkPermission($user, [], self::abilities['DELETE']) && $module->can_delete;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Module $module): bool
    {
        return Helper::checkPermission($user, [], self::abilities['RESTORE']) && $module->can_delete;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Module $module): bool
    {
        return Helper::checkPermission($user, [], self::abilities['FORCE_DELETE']) && $module->can_delete;
    }
}
