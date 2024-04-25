<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class TasksWidget extends BaseWidget
{
    private $totalTasks;
    private $totalPending;
    private $totalOngoing;
    private $totalCompleted;

    public function __construct()
    {
        $this->totalTasks = Task::count();
        $this->totalPending = Task::whereStatusId(1)->count();
        $this->totalOngoing = Task::whereStatusId(2)->count();
        $this->totalCompleted = Task::whereStatusId(3)->count();
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Pending Tasks', Number::abbreviate($this->totalPending, 10, 2))
                ->description(self::getPendingPercentage())
                ->color('danger'),
            Stat::make('Ongoing Tasks', Number::abbreviate($this->totalOngoing, 10, 2))
                ->description(self::getOngoingPercentage())
                ->color('warning'),
            Stat::make('Completed Tasks', Number::abbreviate($this->totalCompleted, 10, 2))
                ->description(self::getCompletedPercentage())
                ->color('success'),
        ];
    }
    private function getPendingPercentage(): string
    {
        return Number::percentage(($this->totalPending / $this->totalTasks) * 100, 10, 2) . ' of tasks are pending';
    }
    private function getOngoingPercentage(): string
    {
        return Number::percentage(($this->totalOngoing / $this->totalTasks) * 100, 10, 2) . ' of tasks are ongoing';
    }
    private function getCompletedPercentage(): string
    {
        return Number::percentage(($this->totalCompleted / $this->totalTasks) * 100, 10, 2) . ' of tasks are completed';
    }
}
