<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Enums\Notifications;
use App\Filament\Resources\PermissionResource;
use App\Models\Permission;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPermission extends EditRecord
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->action(function (Permission $record) {
                    if ($record->modulePermissionRole->isNotEmpty()) {
                        Notification::make()
                            ->danger()
                            ->title(Notifications::DEFAULT_FAILED_TITLE)
                            ->body(Notifications::PERMISSION_DELETE_FAILED_BODY)
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
