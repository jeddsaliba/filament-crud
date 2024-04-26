<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    CONST abilities = [
        'VIEW' => 'view-user',
        'CREATE' => 'create-user',
        'UPDATE' => 'update-user',
        'DELETE' => 'delete-user',
        'RESTORE' => 'restore-user',
        'FORCE_DELETE' => 'force-delete-user'
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
    public function view(User $user, User $model): bool
    {
        return Helper::checkPermission($user, [], self::abilities['VIEW']) && $model->id !== Auth::id();
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
    public function update(User $user, User $model): bool
    {
        return Helper::checkPermission($user, [], self::abilities['UPDATE']) && $model->id !== Auth::id();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return Helper::checkPermission($user, [], self::abilities['DELETE']) && $model->id !== Auth::id();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return Helper::checkPermission($user, [], self::abilities['RESTORE']) && $model->id !== Auth::id();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return Helper::checkPermission($user, [], self::abilities['FORCE_DELETE']) && $model->id !== Auth::id();
    }
}
