<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Models\Module;
use App\Models\ModuleRole;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }

    protected function afterCreate(): void
    {
        $storedDataId = $this->record->getKey();
        Module::all()->each(function ($module) use ($storedDataId) {
            ModuleRole::insert([
                'role_id' => $storedDataId,
                'module_id' => $module->id
            ]);
        });
    }
}
