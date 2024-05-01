<?php
namespace App\Filament\Resources\StatusResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\StatusResource;
use Illuminate\Routing\Router;


class StatusApiService extends ApiService
{
    protected static string | null $resource = StatusResource::class;

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
