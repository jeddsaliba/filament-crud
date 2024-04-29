<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulePermissionRole extends Model
{
    use HasFactory;

    protected $table = 'module_permission_role';

    protected $fillable = [
        'module_id',
        'permission_id',
        'role_id'
    ];

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'module_id' => 'integer',
            'permission_id' => 'integer',
            'role_id' => 'integer'
        ];
    }
}
