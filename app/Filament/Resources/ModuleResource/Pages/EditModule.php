<?php

namespace App\Filament\Resources\ModuleResource\Pages;

use App\Enums\Notifications;
use App\Filament\Resources\ModuleResource;
use App\Models\Module;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditModule extends EditRecord
{
    protected static string $resource = ModuleResource::class;

    protected ?string $heading = 'Edit Module';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->action(function (Module $record) {
                    if ($record->modulePermissions->isNotEmpty()) {
                        Notification::make()
                            ->danger()
                            ->title(Notifications::DEFAULT_FAILED_TITLE)
                            ->body(Notifications::MODULE_DELETE_FAILED_BODY)
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
