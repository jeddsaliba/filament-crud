<?php

namespace App\Filament\Resources\ModuleResource\Pages;

use App\Filament\Resources\ModuleResource;
use App\Models\Module;
use App\Models\ModuleRole;
use App\Models\Role;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModule extends CreateRecord
{
    protected static string $resource = ModuleResource::class;

    protected function afterCreate(): void
    {
        $id = $this->record->id;
        Role::all()->each(function ($role) use ($id) {
            ModuleRole::insert([
                'role_id' => $role->id,
                'module_id' => $id
            ]);
        });
    }
}
