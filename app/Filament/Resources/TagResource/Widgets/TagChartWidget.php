<?php

namespace App\Filament\Resources\TagResource\Widgets;

use App\Models\ProjectTag;
use App\Models\Tag;
use App\Models\TagTask;
use App\Policies\TagPolicy;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TagChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Trending Tags';

    protected static ?string $description = 'Commonly used tags for projects and tasks.';

    protected int | string | array $columnSpan = '1';

    protected static ?int $sort = 1;

    protected static string $color = 'success';

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $tagChartData = (new Tag())->tagChart();
        return [
            'labels' => $tagChartData->pluck('name')->toArray(),
            'datasets' => [
                [
                    'label' => 'Total Tags',
                    'data' => $tagChartData->pluck('total_tags')->toArray()
                ]
            ]
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public static function canView(): bool
    {
        return (new TagPolicy())->viewAny(Auth::user());
    }
}
