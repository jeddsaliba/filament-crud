<?php

namespace App\Filament\Resources\StatusResource\Widgets;

use App\Models\Status;
use App\Policies\StatusPolicy;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class StatusChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Status Updates';

    protected static ?string $description = 'Status report per date.';

    protected int | string | array $columnSpan = '1';

    protected static ?int $sort = 2;

    // protected static ?array $options = [
    //     'plugins' => [
    //         'legend' => [
    //             'display' => false,
    //         ],
    //     ],
    // ];

    protected function getData(): array
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $datasets = (new Status())->getStatusUpdates($months);
        return [
            'datasets' => $datasets,
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public static function canView(): bool
    {
        return (new StatusPolicy())->viewAny(Auth::user());
    }
}
