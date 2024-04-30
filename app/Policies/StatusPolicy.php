<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Models\Status;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StatusPolicy
{
    CONST abilities = [
        'VIEW' => 'view-status',
        'CREATE' => 'create-status',
        'UPDATE' => 'update-status',
        'DELETE' => 'delete-status',
        'RESTORE' => 'restore-user',
        'FORCE_DELETE' => 'force-delete-status'
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
    public function view(User $user, Status $status): bool
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
    public function update(User $user, Status $status): bool
    {
        return Helper::checkPermission($user, [], self::abilities['UPDATE']) && $status->can_edit;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Status $status): bool
    {
        return Helper::checkPermission($user, [], self::abilities['DELETE']) && $status->can_delete;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Status $status): bool
    {
        return Helper::checkPermission($user, [], self::abilities['RESTORE']) && $status->can_delete;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Status $status): bool
    {
        return Helper::checkPermission($user, [], self::abilities['FORCE_DELETE']) && $status->can_delete;
    }
}
