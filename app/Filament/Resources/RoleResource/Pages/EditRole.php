<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Enums\Notifications;
use App\Filament\Resources\RoleResource;
use App\Models\Role;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->action(function (Role $record) {
                    if ($record->users->isNotEmpty()) {
                        Notification::make()
                            ->danger()
                            ->title(Notifications::DEFAULT_FAILED_TITLE)
                            ->body(Notifications::ROLE_DELETE_FAILED_BODY)
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
