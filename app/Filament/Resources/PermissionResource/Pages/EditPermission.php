<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use App\Models\Permission;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditPermission extends EditRecord
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(fn(Permission $record) => $record->can_delete),
        ];
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
            ->submit('save')
            ->keyBindings(['mod+s'])
            ->visible(fn (Permission $record) => $record->can_edit);
    }
}
