<?php
namespace App\Filament\Resources\ModuleResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ModuleResource;
use Illuminate\Routing\Router;


class ModuleApiService extends ApiService
{
    protected static string | null $resource = ModuleResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
