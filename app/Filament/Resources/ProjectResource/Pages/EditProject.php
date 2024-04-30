<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Enums\Notifications;
use App\Filament\Resources\ProjectResource;
use App\Models\Project;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->action(function (Project $record) {
                    if ($record->tasks->isNotEmpty()) {
                        Notification::make()
                            ->danger()
                            ->title(Notifications::DEFAULT_FAILED_TITLE)
                            ->body(Notifications::PROJECT_DELETE_FAILED_BODY)
                            ->send();
                        return;
                    }
                    Notification::make()
                        ->success()
                        ->title(Notifications::DEFAULT_SUCCESS_TITLE)
                        ->send();
                    $record->delete();
                }),
            Actions\RestoreAction::make(),
            Actions\ForceDeleteAction::make()
        ];
    }
}
