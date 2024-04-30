<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tags';

    protected $fillable = [
        'name'
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
            'name' => 'string'
        ];
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }

    public function tagChart()
    {
        $tagProjectQuery = ProjectTag::select('tag_id');
        $unionQuery = TagTask::select('tag_id')->unionAll($tagProjectQuery);
        $query = DB::table(DB::raw("({$unionQuery->toSql()}) AS merged_tags"))
            ->selectRaw("merged_tags.tag_id, count(merged_tags.tag_id) as total_tags, $this->table.name")
            ->join($this->table, $this->table.'.id', '=', 'merged_tags.tag_id')
            ->groupBy('merged_tags.tag_id')
            ->orderBy('total_tags', 'desc')
            ->limit(10);
        return $query->get();
    }
}
