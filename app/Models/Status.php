<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'color',
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
            'color' => 'string',
            'can_edit' => 'boolean',
            'can_delete' => 'boolean'
        ];
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function getStatusUpdates(array $months): array
    {
        $query = Status::orderBy('id', 'asc')->get();
        $datasets = [];
        foreach ($query as $status) {
            $data = [];
            foreach ($months as $month) {
                $date = Carbon::parse("1 ".$month)->format('Y-m');
                $task = Task::select(DB::raw('COUNT(id) as total'), DB::raw("DATE_FORMAT(updated_at, '%Y-%m') as month_year"))
                    ->where(['status_id' => $status->id])
                    ->whereRaw("DATE_FORMAT(updated_at, '%Y-%m') = ?", [$date])
                    ->groupBy('month_year')->first();
                $data[] = $task ? $task->total : 0;
            }
            $datasets[] = [
                'label' => $status->name,
                'borderColor' => $status->color ?? null,
                'pointBackgroundColor' => '#FFF',
                'data' => $data
            ];
        }
        return $datasets;
    }
}
