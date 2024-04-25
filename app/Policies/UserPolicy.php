<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    private $permissions;

    const abilities = [
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
        $canAccess = $this->getPermissions($user)->filter(function ($permission) {
            return in_array($permission, collect(self::abilities)->values()->toArray());
        })->isNotEmpty();
        return $canAccess;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        $this->permissions = $this->getPermissions($user);
        return in_array(self::abilities['VIEW'], $this->permissions->toArray());
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $this->permissions = $this->getPermissions($user);
        return in_array(self::abilities['CREATE'], $this->permissions->toArray());
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        $this->permissions = $this->getPermissions($user);
        return in_array(self::abilities['UPDATE'], $this->permissions->toArray());
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        $this->permissions = $this->getPermissions($user);
        return in_array(self::abilities['DELETE'], $this->permissions->toArray());
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        $this->permissions = $this->getPermissions($user);
        return in_array(self::abilities['RESTORE'], $this->permissions->toArray());
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        $this->permissions = $this->getPermissions($user);
        return in_array(self::abilities['FORCE_DELETE'], $this->permissions->toArray());
    }

    public function getPermissions(User $user)
    {
        return $user->role->permissions->pluck('slug');
    }
}
