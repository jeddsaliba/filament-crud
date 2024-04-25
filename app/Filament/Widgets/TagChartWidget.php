<?php

namespace App\Filament\Widgets;

use App\Models\ProjectTag;
use App\Models\Tag;
use App\Models\TagTask;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TagChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Trending Tags';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $tagTaskTrend = TagTask::select(DB::raw('COUNT(*) as total'), 'tag_id')->groupBy('tag_id')->orderBy('total', 'desc')->limit(10)->get();
        $tagTaskLabel = $tagTaskTrend->map(function ($tag) {
            return Tag::find($tag->tag_id)->name;
        });

        $projectTagTrend = ProjectTag::select(DB::raw('COUNT(*) as total'), 'project_id')->groupBy('project_id')->orderBy('total', 'desc')->limit(10)->get();
        
        return [
            'labels' => $tagTaskLabel,
            'datasets' => [
                [
                    'label' => 'Tags in Tasks',
                    'data' => $tagTaskTrend->pluck('total')->toArray()
                ]
            ]
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
