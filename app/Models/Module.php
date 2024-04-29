<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
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
            'slug' => 'string',
            'description' => 'string',
            'can_edit' => 'boolean',
            'can_delete' => 'boolean'
        ];
    }

    public function permissions(): BelongsToMany
    {   
        $modulePermissionRoleTable = (new ModulePermissionRole())->getTable();
        return $this->belongsToMany(Permission::class, $modulePermissionRoleTable);
    }

    public function modulePermissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(ModuleRole::class);
    }

    public function setRoleId(int $id)
    {
        return $this->role_id = $id;
    }
}
