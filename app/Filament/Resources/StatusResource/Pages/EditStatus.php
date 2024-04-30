<?php

namespace App\Filament\Resources\StatusResource\Pages;

use App\Enums\Notifications;
use App\Filament\Resources\StatusResource;
use App\Models\Status;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditStatus extends EditRecord
{
    protected static string $resource = StatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->action(function (Status $record) {
                    if ($record->tasks->isNotEmpty()) {
                        Notification::make()
                            ->danger()
                            ->title(Notifications::DEFAULT_FAILED_TITLE)
                            ->body(Notifications::STATUS_DELETE_FAILED_BODY)
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
