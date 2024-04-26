<?php

namespace App\Policies;

use App\Helpers\Helper;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    CONST abilities = [
        'VIEW' => 'view-project',
        'CREATE' => 'create-project',
        'UPDATE' => 'update-project',
        'DELETE' => 'delete-project',
        'RESTORE' => 'restore-project',
        'FORCE_DELETE' => 'force-delete-project'
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
    public function view(User $user, Project $project): bool
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
    public function update(User $user, Project $project): bool
    {
        return Helper::checkPermission($user, [], self::abilities['UPDATE']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        return Helper::checkPermission($user, [], self::abilities['DELETE']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        return Helper::checkPermission($user, [], self::abilities['RESTORE']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        return Helper::checkPermission($user, [], self::abilities['FORCE_DELETE']);
    }
}