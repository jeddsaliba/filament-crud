<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'can_edit',
        'can_delete'
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
            'name' => 'string',
            'can_edit' => 'boolean',
            'can_delete' => 'boolean'
        ];
    }
    
    protected function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function modules(): BelongsToMany
    {
        $modulesTable = (new Module())->getTable();
        return $this->belongsToMany(Module::class)->orderBy("$modulesTable.name", 'asc');
    }

    public function accessPermissions(): BelongsToMany
    {
        $modulePermissionRoleTable = (new ModulePermissionRole)->getTable();
        return $this->belongsToMany(Permission::class, $modulePermissionRoleTable);
    }
}
