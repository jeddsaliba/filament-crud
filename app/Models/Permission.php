<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'module_id',
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
            'module_id' => 'integer',
            'name' => 'string',
            'slug' => 'string',
            'description' => 'string',
            'can_edit' => 'boolean',
            'can_delete' => 'boolean'
        ];
    }
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
    public function modulePermissionRole(): HasMany
    {
        return $this->hasMany(ModulePermissionRole::class);
    }
}
