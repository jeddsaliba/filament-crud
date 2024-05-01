<?php
namespace App\Filament\Resources\ModuleResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ModuleResource;
use App\Models\ModuleRole;
use App\Models\Role;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = ModuleResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    public function handler(Request $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        $this->afterCreate($model->id);
        
        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }

    protected function afterCreate(int $id): void
    {
        Role::all()->each(function ($role) use ($id) {
            ModuleRole::insert([
                'role_id' => $role->id,
                'module_id' => $id
            ]);
        });
    }
}