<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Helper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function checkPermission(User $user, array $abilities = [], string $ability = null): bool
    {
        $canAccessModule = $user->role->permissions->pluck('slug');
        if ($abilities) {
            return $canAccessModule->filter(function ($permission) use ($abilities) {
                return in_array($permission, $abilities);
            })->isNotEmpty();
        }
        return in_array($ability, $canAccessModule->toArray());
    }
}
